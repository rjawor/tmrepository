<?php
namespace App\Exporter;

use Cake\Core\Exception\Exception;

class TxtExporter extends Exporter {
	private $_sourceFile;
	
	private $_sourceFilePath;

	private $_targetFile;
	
	private $_targetFilePath;

	public function init($translationMemory) {
		$this->_exportedFilePath = '/tmp/tm_'.$translationMemory->id.'.zip';
		if (file_exists($this->_exportedFilePath)) {
			unlink($this->_exportedFilePath);
		}

		$this->_sourceFilePath = '/tmp/tm_'.$translationMemory->id.'_'.$translationMemory->source_language->code.'.txt';
		$this->_targetFilePath = '/tmp/tm_'.$translationMemory->id.'_'.$translationMemory->target_language->code.'.txt';
		if (file_exists($this->_sourceFilePath)) {
			unlink($this->_sourceFilePath);
		}
		if (file_exists($this->_targetFilePath)) {
			unlink($this->_targetFilePath);
		}

		$this->_sourceFile = fopen($this->_sourceFilePath, 'a');
		$this->_targetFile = fopen($this->_targetFilePath, 'a');
	}
		
	protected function _writeUnit($unit, $reversed) {
		fwrite($this->_sourceFile, $unit->source_segment."\n");
		fwrite($this->_targetFile, $unit->target_segment."\n");

	}

	public function close() {
		fclose($this->_sourceFile);
		fclose($this->_targetFile);
			
		exec("zip -j ".$this->_exportedFilePath." ".$this->_sourceFilePath." ".$this->_targetFilePath, $output, $return_value);
		if ($return_value != 0) {
			throw new Exception("Could not crate zip archive: ".$this->_exportedFilePath." command output: ".join(" ",$output));
		}
	}
	
}
?>
