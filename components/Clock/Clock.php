<?php

class Clock extends xphp_tag {
	public function render(): string {
	    $result = $this->get_view('horloge')->render();
		return $result;
	}
}