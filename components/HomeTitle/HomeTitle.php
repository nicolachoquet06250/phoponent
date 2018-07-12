<?php

class HomeTitle extends xphp_tag {
	public function render(): string {
        $title = $this->get_model('Title')->get_title($this->attribute('TitleView'));
		return $this->get_view('HomeTitle')->set_vars([
															   'TitleView' => $title,
        ])->render();
	}
}