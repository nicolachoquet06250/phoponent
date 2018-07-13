<?php
namespace phoponent\framework\loading;


class Auto {
    protected static $dependencies = [];

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
		self::$dependencies = [
		    // Framework

            // Traits
            'traits' => [
                'static_class' => \phoponent\framework\traits\static_class::class,
                'view' => \phoponent\framework\traits\view::class,
                'model' => \phoponent\framework\traits\model::class,
                'service' => \phoponent\framework\traits\service::class,
                'command' => \phoponent\framework\traits\command::class,
            ],

            // Classes
            'classes' => [
                'regexp' => \phoponent\framework\static_classe\regexp::class,
                'phoponent' => \phoponent\framework\static_classe\xphp::class,
                'component' => \phoponent\framework\classe\xphp_tag::class,
                'class_command' => \phoponent\framework\static_classe\command::class,
             ],

            // Services
            'services' => [
                'json_reader' => \phoponent\framework\service\json_reader::class,
                'json_writer' => \phoponent\framework\service\json_writer::class,
                'translation' => \phoponent\framework\service\translation::class,
            ],
		];
	}

	public static function dependencie($type, $name = null) {
	    self::dependencies();
	    if($name) {
            return isset(self::$dependencies[$type][$name]) ? self::$dependencies[$type][$name] : null;
        }
	    return isset(self::$dependencies[$type]) ? self::$dependencies[$type] : null;
    }
}