<?php
namespace phoponent\framework\traits;

use Exception;

trait command {
	private $argv = [];

	protected static $LOG_ECHO = 'echo';
	protected static $LOG_FILE = '';

	public function __construct($argv = []) {
		$this->argv = $argv;
		$this->after_connstruct();
	}

	protected function after_connstruct() {}

	protected function log($text = '', $type_log = 'echo') {
		if ($type_log === self::$LOG_FILE) {
			$path = str_replace('/'.basename(self::$LOG_FILE), '', self::$LOG_FILE);
			if(!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$content = '';
			if(is_file(self::$LOG_FILE)) {
				$content = file_get_contents(self::$LOG_FILE);
			}

			file_put_contents(self::$LOG_FILE, $content."\n".date('#~ '.exec('echo $USER').': '.$text));
		}
		else {
			echo date('Y-m-d H:i:s').' '.exec('echo $USER').' #~ '.$text."\n";
		}
	}

	protected function before_run() {}

	protected function after_run() {}

	protected function run() {}

	protected function argument($name) {
		foreach ($this->argv as $argv) {
			if(explode('=', $argv)[0] === $name) {
				return explode('=', $argv)[1];
			}
		}
		return null;
	}

	/**
	 * @param string $method
	 * @return bool
	 * @throws Exception
	 */
	public function execute($method = 'run') {
		$this->before_run();
		if(in_array($method, get_class_methods(get_class($this)))) {
			$this->$method();
			$this->after_run();
			return true;
		}
		throw new Exception("method ".explode('\\', __CLASS__)[count(explode('\\', __CLASS__))-1]."::{$method}() not found");
	}
}