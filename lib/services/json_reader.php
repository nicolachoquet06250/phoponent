<?php

class json_reader {
	use service;
	protected $file = '';

	public function set_file($file) {
		$this->file = "$file.json";
		return $this;
	}

	public function get_datas() {
		return json_decode(file_get_contents($this->file));
	}
}