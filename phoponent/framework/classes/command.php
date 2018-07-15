<?php

/**
 * © 2018 - Phoponent
 * Author: Nicolas Choquet
 * Email: nicolachoquet06250@gmail.com
 * LICENSE GPL ( GNU General Public License )
 */

namespace phoponent\framework\static_classe;

use Exception;
use phoponent\framework\command\help;
use phoponent\framework\traits\static_class;

class command {
	use static_class;

	private static function clean_argv($argv) {
		unset($argv[0]);
		$argv_tmp = [];
		foreach ($argv as $item) {
			$argv_tmp[] = $item;
		}
		return $argv_tmp;
	}

	/**
	 * @param $argv
	 * @throws Exception
	 */
	public static function go($argv) {
		$argv = self::clean_argv($argv);
		if(empty($argv) || (!empty($argv) && $argv[0] === '-h') || (!empty($argv) && $argv[0] === '--help')) {
			$argv = self::clean_argv($argv);
			if(is_file("phoponent/commands/help.php")) {
				require_once "phoponent/commands/help.php";
			}
			else {
				throw new Exception("command help not found !");
			}
			$command = new help($argv);
			$command->execute();
			return;
		}
		$command = explode(':', $argv[0]);
		$command_class = $command[0];
		$command_method = isset($command[1]) ? $command[1] : null;
		$argv = self::clean_argv($argv);
		if(is_file("phoponent/commands/{$command_class}.php")) {
			require_once "phoponent/commands/{$command_class}.php";
		}
		else {
			throw new Exception("command {$command_class} not found !");
		}
		$command_class = "\\phoponent\\framework\\command\\{$command_class}";
		$command_obj = new $command_class($argv);
		if($command_method) {
            $command_obj->execute($command_method);
        }
        else {
            $command_obj->execute();
        }
	}
}