<?php
require_once 'lib/Autoload.php';
ini_set('display_errors', 'on');

class index {
    use static_class;
	public static function start($argv) {
		return xphp::parse($argv[1]);
	}
}

$argv = !isset($argv)
    ? [
        1 => str_replace(basename(__DIR__).'/index.php', '', substr($_SERVER['REQUEST_URI'], 1, strlen($_SERVER['REQUEST_URI'])))
    ]
        : $argv;
echo index::start($argv);

//TODO transformer la librairie en framework et nomer le framework Phoponent