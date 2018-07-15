<?php

namespace phoponent\framework\static_classe;

use phoponent\framework\traits\static_class;

class debug {
    use static_class;
    const TRUE = '1', FALSE = '0';
    private static $file_path = 'phoponent/framework/debug.info';

    public static function set_debug() {
        if(!is_file(self::$file_path)) {
            file_put_contents(self::$file_path, self::FALSE);
        }
        if((integer)file_get_contents(self::$file_path) === 1) {
            file_put_contents(self::$file_path, self::FALSE);
        }
        else {
            file_put_contents(self::$file_path, self::TRUE);
        }
    }

    public static function get_debug(): bool {
        if(!is_file(self::$file_path)) {
            file_put_contents(self::$file_path, self::FALSE);
        }
        return (boolean)(integer)file_get_contents(self::$file_path);
    }
}