<?php
namespace phoponent\framework\service;

use phoponent\framework\traits\service;
require_once __DIR__.'../../../external_libs/google-translate-php/vendor/autoload.php';

use Stichoza\GoogleTranslate\TranslateClient;

class translation {
	use service;
	private static $base_url = 'http://translate.google.cn/translate_a/single';

	/**
	 * @param string|array $text
	 * @param array        $array
	 * @param string       $lang
	 * @return string|array
	 * @throws Exception
	 */
	public static function __($text, $array = [], $lang = 'en') {
		$translate_object = new TranslateClient();
		$translate_object->setUrlBase(self::$base_url);
		$translate_object->setTarget($lang);
		if(gettype($text) === 'array') {
			$translated = [];
			foreach ($text as $item) {
				$translated[] = $translate_object->translate($item);
			}
			if(!empty($array)) {
				foreach ($text as $text_id => $item) {
					if(isset($array[$text_id])) {
						foreach ($array[$text_id] as $id => $value) {
							$id         = $id+1;
							$translated[$text_id] = str_replace(["\$ {$id}", "\${$id}"], $value, $translated[$text_id]);
						}
					}
				}
			}
		}
		else {
			$translated = $translate_object->translate($text);
			if(!empty($array)) {
				foreach ($array as $id => $value) {
					$id = $id+1;
					$translated = str_replace(["\$ {$id}", "\${$id}"], $value, $translated);
				}
			}
		}
		return $translated;
	}
}