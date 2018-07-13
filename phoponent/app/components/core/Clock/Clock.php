<?php
namespace phoponent\app\component\core;

use phoponent\framework\classe\xphp_tag;

class Clock extends xphp_tag {
	public function render(): string {
	    $result = $this->get_view('horloge')->render();
		return $result;
	}
}