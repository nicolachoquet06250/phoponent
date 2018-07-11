<?php
    class my_Table_model {
        use model;
        
        public function get_datas_from_json($file) {
        	return $this->get_service('json_reader')
						->set('file', $file)
						->get('datas');
        }
    }