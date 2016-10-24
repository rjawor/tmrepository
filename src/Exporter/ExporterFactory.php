<?php
namespace App\Exporter;

use Cake\Core\Exception\Exception;

class ExporterFactory {
	public static function createForFormat($exportFormat) {
		if ($exportFormat == "txt") {
			return new TxtExporter();
		} else if ($exportFormat == "tmx") {
			return new TmxExporter();
		} else {
			throw new Exception('Unknown export format: '.$exportFormat);
		}
	}
}
?>
