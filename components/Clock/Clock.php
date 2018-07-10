<?php

class Clock extends xphp_tag {
	public function render(): string {
	    $this->get_model('first_model')->echo_toto();
	    $result = $this->get_view('horloge')->render();
		return $result;
	}
}