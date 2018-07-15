<?php

/**
 * © 2018 - Phoponent
 * Author: Nicolas Choquet
 * Email: nicolachoquet06250@gmail.com
 * LICENSE GPL ( GNU General Public License )
 */

namespace phoponent\framework\command;


use phoponent\framework\traits\command;

class initialize {
    use command;

    public function dependencies() {
        $dir = opendir("phoponent/external_libs");
        while (($directory = readdir($dir)) !== false) {
            if($directory !== '..' && $directory !== '.') {
                exec("cd phoponent/external_libs/{$directory} && composer install");
            }
        }
    }
}