<?php
namespace App\Exporter;

use Cake\Core\Exception\Exception;

class TxtExporter extends Exporter {
	private $_sourceFile;

	private $_sourceFilePath;

	private $_targetFile;

	private $_targetFilePath;

	public function init($fileName, $sourceLanguageCode, $targetLanguageCode)
	{
		$this->_exportedFilePath = '/tmp/'.$fileName.'.zip';
		if (file_exists($this->_exportedFilePath)) {
			unlink($this->_exportedFilePath);
		}

		$this->_sourceFilePath = '/tmp/'.$fileName.'_'.$sourceLanguageCode.'.txt';
		$this->_targetFilePath = '/tmp/'.$fileName.'_'.$targetLanguageCode.'.txt';
		if (file_exists($this->_sourceFilePath)) {
			unlink($this->_sourceFilePath);
		}
		if (file_exists($this->_targetFilePath)) {
			unlink($this->_targetFilePath);
		}

		$this->_sourceFile = fopen($this->_sourceFilePath, 'w');
		$this->_targetFile = fopen($this->_targetFilePath, 'w');
	}

	protected function _writeUnit($unit, $reversed) {
		if ($reversed)
		{
			fwrite($this->_sourceFile, $unit->target_segment."\n");
			fwrite($this->_targetFile, $unit->source_segment."\n");
		}
		else
		{
			fwrite($this->_sourceFile, $unit->source_segment."\n");
			fwrite($this->_targetFile, $unit->target_segment."\n");
		}

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
