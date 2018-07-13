<?php
namespace phoponent\app\component\custom;

use phoponent\framework\classe\xphp_tag;

class Clock extends \phoponent\app\component\core\Clock {
	public function render(): string {
	    $result = $this->get_view('horloge')->render();
		return $result;
	}
}