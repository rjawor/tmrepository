<?php
namespace App\Exporter;

use Cake\Core\Exception\Exception;

class ExporterFactory {
	public static function createForType($exporterType) {
		if ($exporterType == "txt") {
			return new TxtExporter();
		} else if ($exporterType == "tmx") {
			return new TmxExporter();
		} else {
			throw new Exception('Unknown exporter type: '.$exporterType);
		}
	}
}
?>
