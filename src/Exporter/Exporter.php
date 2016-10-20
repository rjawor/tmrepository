<?php
namespace App\Exporter;

use Cake\ORM\TableRegistry;

class Exporter {

	protected $_exportedFilePath;
	
	public function getExportedFilePath() {
		return $this->_exportedFilePath;
	}

	public function init($translationMemory) {
	}
	
	public function writeTm($tmId, $reversed = false) {
		$unitsTable = TableRegistry::get('Units');
		$units = $unitsTable->find('all')->where(['Units.translation_memory_id' => $tmId]);
		foreach ($units as $unit) {
			$this->_writeUnit($unit, $reversed);
		}

	}
	
	protected function _writeUnit($unit, $reversed) {
	}

	public function close() {
	}

}
?>
