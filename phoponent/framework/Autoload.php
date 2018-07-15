<?php
namespace phoponent\framework\loading;


use phoponent\framework\static_classe\debug;

class Auto {
    protected static $dependencies = [];

    private static function debug_page() {
        ini_set('display_errors', 'off');
        if(debug::get_debug()) {
            ini_set('display_errors', 'on');
        }
    }

	public static function load() {
		require_once 'traits/static_class.php';
        require_once 'classes/debug.php';
        self::debug_page();
		require_once 'traits/view.php';
		require_once 'traits/model.php';
		require_once 'traits/service.php';
		require_once 'traits/command.php';
		require_once 'classes/regexp.php';
		require_once 'classes/xphp.php';
		require_once 'classes/xphp_tag.php';
		require_once 'classes/command.php';

		require_once 'classes/index.php';
	}

	public static function dependencies() {
		self::$dependencies = [
		    // Framework

            // Traits
            'traits' => [
                'static_class' => [
                    'path' => __DIR__.'/traits/static_class.php',
                    'class' => \phoponent\framework\traits\static_class::class,
                ],
                'view' => [
                    'path' => __DIR__.'/traits/view.php',
                    'class' => \phoponent\framework\traits\view::class,
                ],
                'model' => [
                    'path' => __DIR__.'/traits/model.php',
                    'class' => \phoponent\framework\traits\model::class,
                ],
                'service' => [
                    'path' => __DIR__.'/traits/service.php',
                    'class' => \phoponent\framework\traits\service::class,
                ],
                'command' => [
                    'path' => __DIR__.'/traits/command.php',
                    'class' => \phoponent\framework\traits\command::class,
                ],
            ],

            // Classes
            'classes' => [
                'regexp' => [
                    'path' => __DIR__.'/classes/regexp.php',
                    \phoponent\framework\static_classe\regexp::class,
                ],
                'phoponent' => [
                    'path' => __DIR__.'/classes/xphp.php',
                    \phoponent\framework\static_classe\xphp::class,
                ],
                'component' => [
                    'path' => __DIR__.'/classes/xphp_tag.php',
                    \phoponent\framework\classe\xphp_tag::class,
                ],
                'class_command' => [
                    'path' => __DIR__.'/classes/command.php',
                    \phoponent\framework\static_classe\command::class,
                ],
             ],

            // Services
            'services' => [
                'json_reader' => [
                    'path' => __DIR__.'/services/json_reader.php',
                    'class' => \phoponent\framework\service\json_reader::class,
                ],
                'json_writer' => [
                    'path' => __DIR__.'/services/json_writer.php',
                    'class' => \phoponent\framework\service\json_writer::class,
                ],
                'translation' => [
                    'path' => __DIR__.'/services/translation.php',
                    'class' => \phoponent\framework\service\translation::class,
            ],
            ],

            // Commandes
            'commands' => [
                'help' =>  [
                    'path' => __DIR__.'/../commands/help.php',
                    'class' => \phoponent\framework\command\help::class,
                ],
                'make' => [
                    'path' => __DIR__.'/../commands/make.php',
                    'class' => \phoponent\framework\command\make::class,
                ]
            ],
		];
	}

	public static function dependencie($type, $name = null) {
	    self::dependencies();
	    if($name) {
	        if(isset(self::$dependencies[$type][$name]) && is_file(self::$dependencies[$type][$name]['path'])) {
	            require_once self::$dependencies[$type][$name]['path'];
	            return self::$dependencies[$type][$name]['class'];
            }
            return null;
        }
	    return isset(self::$dependencies[$type]) ? self::$dependencies[$type] : null;
    }
}