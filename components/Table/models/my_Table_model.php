<?php
    class my_Table_model {
        use model;
        
        public function get_datas_from_json($file) {
        	$file = "components/{$this->get_component()}/{$file}";
			/**
			 * @var json_reader $json_reader_service
			 */
        	$json_reader_service = $this->get_service('json_reader');
        	return $json_reader_service
				->set_file($file)
				->get('datas');
        }
    }