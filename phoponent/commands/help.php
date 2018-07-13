<?php
namespace phoponent\framework\command;

use phoponent\framework\traits\command;

class help {
	use command;

	private $commands = [];

	protected function after_connstruct() {
		self::$LOG_FILE = 'phoponent/logs/commands/help.log';
	}

	protected function before_run() {
		$this->commands[] = '';
		$this->commands[] = '-h';
		$this->commands[] = '--help';
		$this->commands[] = 'make:component tag=<valeur>';
	}

	protected function run() {
		foreach ($this->commands as $command) {
			$this->log($command);
		}
	}
}