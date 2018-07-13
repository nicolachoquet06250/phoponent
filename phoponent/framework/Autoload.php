<?php
namespace phoponent\framework\loading;

class Auto {
	public static function load() {
		require_once 'traits/static_class.php';
		require_once 'traits/view.php';
		require_once 'traits/model.php';
		require_once 'traits/service.php';
		require_once 'traits/command.php';
		require_once 'classes/regexp.php';
		require_once 'classes/xphp.php';
		require_once 'classes/xphp_tag.php';
		require_once 'classes/command.php';
	}

	public static function dependencies() {
		return [
			'' => ''
		];
	}
}