<?php

/**
 * © 2018 - Phoponent
 * Author: Nicolas Choquet
 * Email: nicolachoquet06250@gmail.com
 * LICENSE GPL ( GNU General Public License )
 */

namespace phoponent\framework\traits;

trait service {
	public function get($name) {
		if(in_array($name, get_class_vars(get_class($this)))) {
			return $this->$name;
		}
		elseif (in_array("get_{$name}", get_class_methods($this))) {
			$func = "get_{$name}";
			return $this->$func();
		}
		return null;
	}

	public function set($name, $value) {
		if(in_array($name, array_keys(get_class_vars(get_class($this))))) {
			$this->$name = $value;
		}
		elseif (in_array("set_{$name}", get_class_methods($this))) {
			$func = "set_{$name}";
			return $this->$func($value);
		}
		return $this;
	}
}