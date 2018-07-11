<?php
    class Table extends xphp_tag {
    	private function get_table_lines($json_datas) {
			$lines = '';
			foreach ($json_datas as $json_data) {
				$lines .= $this->get_view('my_Table_Line')
							   ->set_vars((array)$json_data)
							   ->render();
			}
			return $lines;
		}

        public function render():string {
            $json_datas = $this->get_model('my_Table_model')
							   ->get_datas_from_json($this->attribute('file'));
			$header_view = $this->get_view('my_Table_header')
								->render();
			$lines = $this->get_table_lines($json_datas);
            $table = $this->get_view('my_Table_view')
						  ->set_vars([
						 	  'header' => $header_view,
							  'lines' => $lines
						  ])->render();
            return $table;
        }
    }