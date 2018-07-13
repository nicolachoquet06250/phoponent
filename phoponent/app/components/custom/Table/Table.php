<?php
namespace phoponent\app\component\custom;

    use Exception;
	use phoponent\framework\service\translation;

	class Table extends \phoponent\app\component\core\Table {

		/**
		 * @return string
		 * @throws Exception
		 */
		public function render():string {
			/**
			 * @var \phoponent\app\component\custom\Table\mvc\model\table $model
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