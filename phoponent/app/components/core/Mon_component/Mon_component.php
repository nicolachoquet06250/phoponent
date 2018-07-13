<?php
namespace phoponent\app\component\core;

    use phoponent\framework\classe\xphp_tag;

	class Mon_component extends xphp_tag {
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