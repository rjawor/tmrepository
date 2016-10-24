<?php
namespace App\Importer;

use Cake\ORM\TableRegistry;

interface Importer {

	public function importUnits($translationMemory, $sourceFilePath, $targetFilePath);

}
?>
