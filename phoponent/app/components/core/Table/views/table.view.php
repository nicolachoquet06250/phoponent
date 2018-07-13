<?php
namespace phoponent\app\component\core\Table\mvc\view;

use phoponent\framework\traits\view;

    class table {
        use view;

        private $header = '';
        private $lines = '';

        public function set_header(string $header) {
        	$this->header = $header;
		}

        public function set_lines(string $lines) {
        	$this->lines = $lines;
		}
	}