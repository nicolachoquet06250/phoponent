<?php

/**
 * © 2018 - Phoponent
 * Author: Nicolas Choquet
 * Email: nicolachoquet06250@gmail.com
 * LICENSE GPL ( GNU General Public License )
 */

namespace phoponent\framework\command;

use phoponent\framework\traits\command;

class help {
	use command;

	private $commands = [];

	protected function after_connstruct() {
		self::$LOG_FILE = 'phoponent/logs/commands/help.log';
	}

	protected function before_run() {
		$this->commands[] = '-h';
		$this->commands[] = '--help';
		$this->commands[] = 'make:component tag=<valeur> ?type=<core/custom>';
		$this->commands[] = '';
		$this->commands[] = '';
		$this->commands[] = 'LEGENDE : ';
		$this->commands[] = '? = optionnel';
	}

	protected function run() {
	    echo '/**********************************************/'."\n";
	    echo '/* © '.date('Y').' - Phoponent *************************/'."\n";
	    echo '/* Author: Nicolas Choquet ********************/'."\n";
	    echo '/* LICENSE GPL ( GNU General Public License ) */'."\n";
	    echo '/**********************************************/'."\n\n";
	    echo "/***********************************************************************/\n";
	    echo "/* PPPPPP  hh                                                   tt     */\n";
        echo "/* PP   PP hh       oooo  pp pp    oooo  nn nnn    eee  nn nnn  tt     */\n";
        echo "/* PPPPPP  hhhhhh  oo  oo ppp  pp oo  oo nnn  nn ee   e nnn  nn tttt   */\n";
        echo "/* PP      hh   hh oo  oo pppppp  oo  oo nn   nn eeeee  nn   nn tt     */\n";
        echo "/* PP      hh   hh  oooo  pp       oooo  nn   nn  eeeee nn   nn  tttt  */\n";
        echo "/*                        pp                                           */\n";
        echo "/***********************************************************************/\n\n";
		foreach ($this->commands as $command) {
			$this->log($command);
		}
	}
}