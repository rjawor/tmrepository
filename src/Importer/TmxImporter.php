<?php
namespace App\Importer;

use Cake\Core\Exception\Exception;
use Cake\Utility\Xml;

class TmxImporter implements Importer {
    public function importUnits($translationMemory, $sourceFilePath, $sourceLanguageId, $targetFilePath, $targetLanguageId)
    {
        if (!file_exists($sourceFilePath) || filesize($sourceFilePath) == 0)
		{
			throw new Exception("Missing or empty source TMX file");
		}

        try
        {
            $tmx = Xml::build($sourceFilePath);
        }
        catch (\Cake\Utility\Exception\XmlException $e)
        {
            throw new Exception("error parsing TMX file");
        }
        die(print_r($tmx, true));
    }
}
?>
