<?php
ini_set('display_errors', 'on');
require_once 'lib/Autoload.php';

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