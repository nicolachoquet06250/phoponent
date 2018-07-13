<?php
namespace phoponent\framework\service;

use phoponent\framework\traits\service;

class json_writer {
	use service;
	protected $file = '';
	protected $datas = [];

	public function set_file($file) {
		$this->file = "$file.json";
		return $this;
	}

	public function set_datas($name, $value) {
		$this->datas[$name] = $value;
	}

	public function write() {
		file_put_contents($this->file, json_encode($this->datas));
	}
}