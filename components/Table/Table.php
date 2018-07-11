<?php
    class Table extends xphp_tag {
        public function render():string {
            $json_datas = $this->get_model('my_Table_model')->get_datas_from_json($this->attribute('file'));
			$header_view = $this->get_view('my_Table_header')->render();
			$lines = '';
			foreach ($json_datas as $json_data) {
				$lines .= $this->get_view('my_Table_Line')
							   ->set_vars((array)$json_data)
							   ->render();
			}
            $view = $this->get_view('my_Table_view')
						 ->set_vars([
						 	'header' => $header_view,
							'lines' => $lines
						])->render();
            return $view;
        }
    }