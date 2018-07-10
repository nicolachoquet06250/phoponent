<?php

class HomeTitle extends xphp_tag {
	public function render(): string {
		$title = is_null($this->attribute('title')) ? 'Accueil' : $this->attribute('title');
		return "<title>{$title}</title>";
	}
}