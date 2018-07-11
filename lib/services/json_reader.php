<?php

class json_reader {
	use service;
	private $file = '';

	public function get_datas() {
		return json_decode(file_get_contents($this->file));
	}
}