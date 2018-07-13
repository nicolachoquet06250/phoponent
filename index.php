<?php

use phoponent\framework\traits\static_class;
use phoponent\framework\static_classe\xphp;

//ini_set('display_errors', 'on');
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

/*
 * TODO Faire un systeme de composants core et custom. si il y a un composant custom, prendre celui la si non prendre la version core.
 *      ( la version custom doit étendre celle du core pour ne pas avoir de perte d'informations, de propriétés undefined ou de méthodes undefined )
*/