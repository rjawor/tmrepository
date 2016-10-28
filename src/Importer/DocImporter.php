<?php

namespace App\Importer;

use Cake\Core\Exception\Exception;
use Cake\ORM\TableRegistry;

class DocImporter implements Importer
{
    private function _extractText($folder, $fileName, $extension)
    {

		$command = "antiword -m UTF-8.txt -w 0 ".$folder.'/'.$fileName.$extension." > ".$folder.'/'.$fileName.'_raw_text.txt';
        system($command, $retval);
        if ($retval != 0)
        {
        	throw new Exception("Error extracting text. Command: ".$command);
        }

        system("sed -i '/^$/d' ".$folder.'/'.$fileName.'_raw_text.txt');
        system("sed -i 's/\t/ /g' ".$folder.'/'.$fileName.'_raw_text.txt');

    }

    private function _srxSplit($folder, $sourceLanguageCode, $targetLanguageCode)
    {
        system("cat ".$folder.'/src_raw_text.txt | eserix -r /usr/share/eserix/srx/rules.srx -l '.$sourceLanguageCode. '> '.$folder.'/src_splitted_text.txt');
        system("cat ".$folder.'/trg_raw_text.txt | eserix -r /usr/share/eserix/srx/rules.srx -l '.$targetLanguageCode. '> '.$folder.'/trg_splitted_text.txt');
    }

    private function _hunalign($folder)
    {
        $tempDictionary = "/tmp/hunalign.dic";
        if (file_exists($tempDictionary))
        {
            unlink($tempDictionary);
        }
        touch($tempDictionary);

        system("hunalign -text -utf -realign ".$tempDictionary." ".$folder."/src_splitted_text.txt ".$folder."/trg_splitted_text.txt > ".$folder."/aligned.txt");
    }

    private function _getMimeType($filePath)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        return finfo_file($finfo, $filePath);
    }

    private function _getExtension($mimeType)
    {
        if ($mimeType == 'application/msword')
        {
            return '.doc';
        }
        else if ($mimeType == 'application/zip')
        {
            return '.docx';
        }
        else
        {
            throw new Exception('Bad input file of type: '.$mimeType);
        }
    }

    public function importUnits($translationMemory, $sourceFilePath, $sourceLanguageId, $targetFilePath, $targetLanguageId)
    {
        if (!file_exists($sourceFilePath) || filesize($sourceFilePath) == 0)
		{
			throw new Exception("Missing or empty source file");
		}
		if (!file_exists($targetFilePath) || filesize($targetFilePath) == 0)
		{
			throw new Exception("Missing or empty target file");
		}

        $folder = "/var/www/html/tmrepository/upload/tm_".$translationMemory->id;
        if (file_exists($folder))
        {
            array_map('unlink', glob("$folder/*.*"));
        }
        else
        {
            mkdir($folder);
        }

        $sourceFileExtension = $this->_getExtension($this->_getMimeType($sourceFilePath));
        move_uploaded_file($sourceFilePath, $folder.'/src'.$sourceFileExtension);

        $targetFileExtension = $this->_getExtension($this->_getMimeType($targetFilePath));
        move_uploaded_file($targetFilePath, $folder.'/trg'.$targetFileExtension);

        $this->_extractText($folder, 'src', $sourceFileExtension);
        $this->_extractText($folder, 'trg', $targetFileExtension);

        $languagesTable = TableRegistry::get('Languages');
        $languagesArray = $languagesTable->find('list', ['keyField' => 'id', 'valueField' => 'code'])->toArray();
        $this->_srxSplit($folder, $languagesArray[$sourceLanguageId], $languagesArray[$targetLanguageId]);

        $this->_hunalign($folder);


        $aligned = fopen($folder.'/aligned.txt', 'r');
        $units = array();
        $unitsTable = TableRegistry::get('Units');
        while (($line = fgets($aligned)) !== false)
        {
            $parts = preg_split('/\t/', $line);
            $sourceSentence = preg_replace('/\s*~~~\s*/', ' ', trim($parts[0]));
            $targetSentence = preg_replace('/\s*~~~\s*/', ' ', trim($parts[1]));
            $unit = $unitsTable->newEntity();
            $unit->source_segment = $sourceSentence;
            $unit->target_segment = $targetSentence;
            array_push($units, $unit);
        }

        fclose($aligned);

        $translationMemory->units = $units;
		$tmTable = TableRegistry::get('TranslationMemories');
        $tmTable->save($translationMemory);
    }
}
