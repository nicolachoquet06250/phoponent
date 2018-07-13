<?php
namespace phoponent\app\component\custom;

	class Mon_component extends \phoponent\app\component\core\Mon_component {
        public function render():string {
            $hello_world = $this->get_model('my_Mon_component')->get_hello_world();
            $view = $this->get_view('my_Mon_component')
                    ->set_vars([
                    'value' => $hello_world,
                    'class' => __CLASS__,
                ])->render();
            return $view;
        }
    }