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


        $src_count = $this->_lineCount($sourceFilePath);
        $trg_count = $this->_lineCount($targetFilePath);

        if ($src_count != $trg_count)
		{
			throw new Exception('Files have different number of lines (source = '.$src_count.' lines, target = '.$trg_count.' lines.)');
		}

        $src = fopen($sourceFilePath, 'r');
        $trg = fopen($targetFilePath, 'r');

        $units = array();
        for ($i = 0; $i < $src_count; ++$i) {
            $src_line = trim(fgets($src));
            $trg_line = trim(fgets($trg));
			$unitsTable = TableRegistry::get('Units');
            $unit = $unitsTable->newEntity();
            $unit->source_segment = $src_line;
            $unit->target_segment = $trg_line;
            array_push($units, $unit);
        }

        fclose($src);
        fclose($trg);

        $translationMemory->units = $units;
		$tmTable = TableRegistry::get('TranslationMemories');
        $tmTable->save($translationMemory);
    }
}
