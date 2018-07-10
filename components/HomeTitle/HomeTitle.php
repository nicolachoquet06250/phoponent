<?php

class HomeTitle extends xphp_tag {
	public function render(): string {
        $title = $this->get_model('Title')->get_title($this->attribute('title'));
		return $this->get_view('HomeTitle_view')->set_vars([
		    'title' => $title,
        ])->render();
	}
}