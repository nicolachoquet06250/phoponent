<?php
    class Main extends xphp_tag {
        public function render():string {
            return $this->get_view('Main')->render();
        }
    }