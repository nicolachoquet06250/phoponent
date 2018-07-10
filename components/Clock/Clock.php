<?php

class Clock extends xphp_tag {
	public function render(): string {
		return '<div>Nous sommes le '.date('d/m/Y').' et il est '.date('H:i').'</div>';
	}
}