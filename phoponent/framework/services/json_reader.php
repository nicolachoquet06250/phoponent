<?php

/**
 * © 2018 - Phoponent
 * Author: Nicolas Choquet
 * Email: nicolachoquet06250@gmail.com
 * LICENSE GPL ( GNU General Public License )
 */

namespace phoponent\framework\service;

use phoponent\framework\traits\service;

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