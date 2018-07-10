<?php
require_once 'lib/Autoload.php';

class index {
	public static function start($argv) {
		return xphp::parse($argv[1]);
	}
}

$argv = !isset($argv) ? [1 => substr($_SERVER['REQUEST_URI'], 1, strlen($_SERVER['REQUEST_URI']))] : $argv;
echo index::start($argv);