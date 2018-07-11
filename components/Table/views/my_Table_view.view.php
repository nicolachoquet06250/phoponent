<?php
    class my_Table_view {
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