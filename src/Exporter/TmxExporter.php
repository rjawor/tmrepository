<?php
namespace App\Exporter;

class TmxExporter extends Exporter {
	private $_tmxFile;

	private $_srcLang;

	private $_trgLang;

	public function init($translationMemory) {
		$this->_exportedFilePath = '/tmp/tm_'.$translationMemory->id.'.tmx';
		if (file_exists($this->_exportedFilePath)) {
			unlink($this->_exportedFilePath);
		}

		$this->_srcLang = $translationMemory->source_language->code;
		$this->_trgLang = $translationMemory->target_language->code;

		$this->_tmxFile = fopen($this->_exportedFilePath, 'a');
		fwrite($this->_tmxFile, "<tmx version=\"1.4\">\n");
  		fwrite($this->_tmxFile, "\t<header\n");
    	fwrite($this->_tmxFile, "\t\tcreationtool=\"TM repository\" creationtoolversion=\"1.0\"\n");
    	fwrite($this->_tmxFile, "\t\tdatatype=\"PlainText\" segtype=\"sentence\"\n");
    	fwrite($this->_tmxFile, "\t\tadminlang=\"en-us\" srclang=\"".$this->_srcLang."\"\n");
    	fwrite($this->_tmxFile, "\t\to-tmf=\"TM repository\"/>\n");
		fwrite($this->_tmxFile, "\t<body>\n");

	}

	protected function _writeUnit($unit, $reversed) {
		fwrite($this->_tmxFile, "\t\t<tu>\n");
		fwrite($this->_tmxFile, "\t\t\t<tuv xml:lang=\"".$this->_srcLang."\">\n");
		fwrite($this->_tmxFile, "\t\t\t\t<seg>".$unit->source_segment."</seg>\n");
		fwrite($this->_tmxFile, "\t\t\t</tuv>\n");
		fwrite($this->_tmxFile, "\t\t\t<tuv xml:lang=\"".$this->_trgLang."\">\n");
		fwrite($this->_tmxFile, "\t\t\t\t<seg>".$unit->target_segment."</seg>\n");
		fwrite($this->_tmxFile, "\t\t\t</tuv>\n");
		fwrite($this->_tmxFile, "\t\t</tu>\n");
	}

	public function close() {
		fwrite($this->_tmxFile, "\t</body>\n");
		fwrite($this->_tmxFile, "</tmx>\n");

		fclose($this->_tmxFile);
	}

}
?>
