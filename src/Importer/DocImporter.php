<?php

namespace App\Importer;

use Cake\Core\Exception\Exception;
use Cake\ORM\TableRegistry;

class DocImporter implements Importer
{
    private function _extractText($filePath)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $srcType = finfo_file($finfo, $sourceFilePath)

    }

    public function importUnits($translationMemory, $sourceFilePath, $targetFilePath)
    {
        if (!file_exists($sourceFilePath) || filesize($sourceFilePath) == 0)
		{
			throw new Exception("Missing or empty source file");
		}
		if (!file_exists($targetFilePath) || filesize($targetFilePath) == 0)
		{
			throw new Exception("Missing or empty target file");
		}

        

        $this->_extractText($sourceFilePath);
        $this->_extractText($targetFilePath);

        $units = array();

        $translationMemory->units = $units;
		$tmTable = TableRegistry::get('TranslationMemories');
        $tmTable->save($translationMemory);
    }
}
