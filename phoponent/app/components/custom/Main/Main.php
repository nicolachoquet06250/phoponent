<?php
namespace phoponent\app\component\custom;

	class Main extends \phoponent\app\component\core\Main {
        public function render():string {
        	return $this->get_view('Main')
						->set_vars([
							'title' => $this->attribute('title')
						])->render();
        }
    }