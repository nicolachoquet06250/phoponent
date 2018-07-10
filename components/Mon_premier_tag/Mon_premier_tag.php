<?php

class Mon_premier_tag extends xphp_tag {
	public function render(): string {
		$__CLASS__ = __CLASS__;
		$content = $this->value() !== '' ? $this->value() : $__CLASS__;
		$id = '';
		if(!is_null($this->attribute('id'))) {
			$id = " id='{$this->attribute('id')}'";
		}
		return "<b{$id}>{$content}</b>";
	}
}