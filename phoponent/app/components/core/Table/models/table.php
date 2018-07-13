<?php
namespace phoponent\app\component\core\Table\mvc\model;

use phoponent\app\component\core\Table\mvc\view\td;
use phoponent\app\component\core\Table\mvc\view\th;
use phoponent\app\component\core\Table\mvc\view\tr;
use phoponent\framework\traits\model;
use phoponent\framework\service\json_reader;

    class table {
        use model;

		private function get_array_keys($array) {
			return array_keys($array);
		}

        public function get_datas_from_json($file) {
        	$file = __DIR__."/../{$file}";
			/**
			 * @var json_reader $json_reader_service
			 */
        	$json_reader_service = $this->get_service('json_reader');
        	return $json_reader_service
				->set_file($file)
				->get('datas');
        }

        public function genere_header(array $json_datas, tr $tr_view, th $th_view) {
        	$json_datas = $this->get_array_keys((array)$json_datas[0]);
			$header = '';
        	foreach ($json_datas as $json_data) {
				foreach ((array)$json_data as $data) {
					$new_th_view = $th_view;
					$header .= 	$new_th_view->set_vars(['text' => $data])->render();
        		}
        	}
        	$tr_view->set_vars(['text' => $header]);
        	return $tr_view->render();
		}

		public function genere_body(array $json_datas, tr $tr_view, td $td_view) {
        	$lines = '';
        	foreach ($json_datas as $id => $json_data) {
        		$json_data = (array)$json_data;
        		$header_keys = $this->get_array_keys($json_data);
				$tr = $tr_view;
				$line = '';
        		foreach ($header_keys as $header_key) {
        			$td = $td_view;
					$line .= $td->set_vars(['text' => ''.$json_data[$header_key]])->render();
        		}
        		$lines .= $tr->set_vars(['text' => $line])->render();
        	}
			return $lines;

		}
    }