<?php
namespace App\Importer;

use Cake\Core\Exception\Exception;
use Cake\ORM\TableRegistry;

class TmxImporter implements Importer {
    public function importUnits($translationMemory, $sourceFilePath, $sourceLanguageId, $targetFilePath, $targetLanguageId)
    {
        if (!file_exists($sourceFilePath) || filesize($sourceFilePath) == 0)
		{
			throw new Exception("Missing or empty source TMX file");
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

        move_uploaded_file($sourceFilePath, $folder.'/bilingual.tmx');

        $languagesTable = TableRegistry::get('Languages');
        $languagesArray = $languagesTable->find('list', ['keyField' => 'id', 'valueField' => 'code'])->toArray();
        $sourceLanguageCode = $languagesArray[$sourceLanguageId];
        $targetLanguageCode = $languagesArray[$targetLanguageId];

        $scriptsHome = "/var/www/html/tmrepository/import/";
        $command = "cat ".$folder.'/bilingual.tmx | '.$scriptsHome.'correct_newlines.py | '.$scriptsHome.'extract_segments.py '.$folder.'/src.txt '.$sourceLanguageCode.' '.$folder.'/trg.txt '.$targetLanguageCode;
        system($command);

        $txtImporter = new TxtImporter();
        $txtImporter->importUnits($translationMemory, $folder.'/src.txt', $sourceLanguageId, $folder.'/trg.txt', $targetLanguageId);

    }
}
?>
