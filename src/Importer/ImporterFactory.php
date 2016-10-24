<?php
namespace App\Importer;

use Cake\Core\Exception\Exception;

class ImporterFactory {
	public static function createForFormat($importFormat) {
		if ($importFormat == "txt") {
			return new TxtImporter();
		} else if ($importFormat == "tmx") {
			return new TmxImporter();
		} else {
			throw new Exception('Unknown import format: '.$importFormat);
		}
	}
}
?>
