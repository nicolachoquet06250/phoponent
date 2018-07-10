<?php

class Mon_premier_tag extends xphp_tag {
	public function render(): string {
	    $model = $this->get_model('props_gestion')
            ->set('id', $this->attribute('id').(!is_null($this->attribute('date')) ? '-'.$this->attribute('date') : ''))
            ->set('class', $this->attribute('class'))
            ->set('value', $this->value() !== '' ? $this->value() : __CLASS__);
	    list($class, $id, $content) = $model->get('infos');

		return $this->get_view('balise')->set_vars([
		    'id' => $id,
            'class' => $class,
            'content' => $content,
        ])->render();
	}
}