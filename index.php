<?php

use phoponent\framework\traits\static_class;
use phoponent\framework\static_classe\xphp;

ini_set('display_errors', 'on');
require_once 'phoponent/Autoload.php';
\phoponent\loading\Auto::load();

class index {
	use static_class;
	public static function start($argv) {
		return xphp::parse($argv[1]);
	}
}

$argv = !isset($argv)
	? [1 => $_GET['p']]
	: $argv;
echo index::start($argv);

//TODO transformer la librairie en framework et nomer le framework Phoponent