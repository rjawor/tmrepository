<?php

namespace App\Importer;

use Cake\Core\Exception\Exception;
use Cake\ORM\TableRegistry;

class TxtImporter implements Importer
{
    private function _lineCount($file_name)
    {
        $linecount = 0;
        $handle = fopen($file_name, 'r');
        while (!feof($handle)) {
            $line = fgets($handle);
            ++$linecount;
        }

        fclose($handle);

        return $linecount;
    }

    public function importUnits($translationMemory, $sourceFilePath, $sourceLanguageId, $targetFilePath, $targetLanguageId)
    {
        if (!file_exists($sourceFilePath) || filesize($sourceFilePath) == 0)
		{
			throw new Exception("Missing or empty source file. If you were importing a TMX, double-check the xml:lang param in source <tuv>'s.");
		}
		if (!file_exists($targetFilePath) || filesize($targetFilePath) == 0)
		{
			throw new Exception("Missing or empty target file. If you were importing a TMX, double-check the xml:lang param in target <tuv>'s.");
		}


        $src_count = $this->_lineCount($sourceFilePath);
        $trg_count = $this->_lineCount($targetFilePath);

        if ($src_count != $trg_count)
		{
			throw new Exception('Files have different number of lines (source = '.$src_count.' lines, target = '.$trg_count.' lines.)');
		} else {
            system("/var/www/html/tmrepository/import/insert_units.py ".$translationMemory->id." ".$sourceFilePath." ".$targetFilePath, $retval);
            if ($retval != 0)
            {
            	throw new Exception("Error importing units to the translation memory id = ".$translationMemory->id.". Try to upload the translation memory again.");
            }
        }
    }
}
