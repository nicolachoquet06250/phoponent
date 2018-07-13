<?php
namespace phoponent\app\component\core;

    use Exception;
	use phoponent\app\component\core\Table\mvc\model\table_model;
	use phoponent\framework\classe\xphp_tag;
	use phoponent\framework\service\translation;

	class Table extends xphp_tag {

		/**
		 * @return string
		 * @throws Exception
		 */
		public function render():string {
			/**
			 * @var table_model $model
			 */
			$model = $this->get_model('table');
			$my_name = 'Nicolas';
			$json_datas = $model->get_datas_from_json($this->attribute('file'));


			$header_view = $model->genere_header(
				$json_datas,
				$this->get_view('tr'),
				$this->get_view('th')
			);
			$lines = $model->genere_body(
				$json_datas,
				$this->get_view('tr'),
				$this->get_view('td')
			);
            $table = $this->get_view('table')
						  ->set_vars([
						  	  'text_in_french' => translation::__($this->attribute('text_to_translate'), [$my_name], 'fr'),
						  	  'text_in_english' => translation::__($this->attribute('text_to_translate'), [$my_name]),
						 	  'header' => $header_view,
							  'lines' => $lines
						  ])->render();

            return $table;
        }
    }