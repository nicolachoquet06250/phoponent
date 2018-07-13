<?php
namespace phoponent\app\component\Mon_component\mvc\model;

use phoponent\framework\traits\model;

    class my_Mon_component_model {
        use model;
        
        public function get_hello_world() {
            return 'Hello World';
        }
    }