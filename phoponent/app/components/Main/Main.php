<?php
namespace phoponent\app\component;

    use phoponent\framework\classe\xphp_tag;

	class Main extends xphp_tag {
        public function render():string {
        	return $this->get_view('Main')
						->set_vars([
							'title' => $this->attribute('title')
						])->render();
        }
    }