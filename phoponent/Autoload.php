<?php
namespace phoponent\loading;
require_once 'framework/Autoload.php';

class Auto extends \phoponent\framework\loading\Auto {
	public static function load() {
		parent::load();
	}

	public static function dependencies() {
		parent::dependencies();
	}
}