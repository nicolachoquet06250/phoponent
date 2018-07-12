<?php
    class Table extends xphp_tag {

    	public static function test() {
    		echo 'toto';
		}

    	private function get_table_lines($json_datas) {
			$lines = '';
			foreach ($json_datas as $json_data) {
				$lines .= $this->get_view('my_Table_Line')
							   ->set_vars((array)$json_data)
							   ->render();
			}
			return $lines;
		}

		/**
		 * @return string
		 * @throws Exception
		 */
		public function render():string {
			$json_datas = $this->get_model('my_Table_model')
							   ->get_datas_from_json($this->attribute('file'));
			$header_view = $this->get_view('my_Table_header')
								->render();
			$lines = $this->get_table_lines($json_datas);
			$my_name = 'Nicolas';
            $table = $this->get_view('my_Table_view')
						  ->set_vars([
						  	  'text_in_french' => translation::__('Je m\'appel $1', [$my_name], 'fr'),
						  	  'text_in_english' => translation::__('Je m\'appel $1', [$my_name]),
						 	  'header' => $header_view,
							  'lines' => $lines
						  ])->render();
            return $table;
        }
    }