<?php

class xphp {
	public static function parse($path) {
		if(strstr($path, 0, 1) === '/') {
			$path = 'src'.$path;
		}
		elseif (strstr($path, 0, 1) !== '/') {
			$path = 'src/'.$path;
		}

		if(!strstr($path, '.') && substr($path, strlen($path)-1, 1) !== '/') {
			$path .= '/index.html';
		}
		elseif (!strstr($path, '.') && substr($path, strlen($path)-1, 1) === '/') {
			$path .= 'index.html';
		}

		if(is_file($path)) {
			$file_content = file_get_contents($path);
			// balise banales avec contenu
			// sans attributs
			preg_replace_callback(regexp::get_regexp_for_no_autoclosed_tags_with_content_and_not_arguments(), function ($matches) use (&$file_content) {
				$class = str_replace('-', '_', $matches[1]);
				if(is_file("components/{$class}/{$class}.php")) {
					require_once "components/{$class}/{$class}.php";
					/**
					 * @var xphp_tag $tag
					 */
					$tag = new $class();
					$tag->value($matches[2]);
					$file_content = str_replace($matches[0], $tag->render(), $file_content);
				}
			}, $file_content);
			// sans attributs mais avec un espace
			preg_replace_callback(regexp::get_regexp_for_no_autoclosed_tags_with_content_and_not_arguments_and_spaces(), function ($matches) use (&$file_content) {
				$class = str_replace('-', '_', $matches[1]);
				if(is_file("components/{$class}/{$class}.php")) {
					require_once "components/{$class}/{$class}.php";
					/**
					 * @var xphp_tag $tag
					 */
					$tag = new $class();
					$tag->value($matches[2]);
					$file_content = str_replace($matches[0], $tag->render(), $file_content);
				}
			}, $file_content);
			// avec attributs
			preg_replace_callback(regexp::get_regexp_for_no_autoclosed_tags_with_content_and_arguments(), function ($matches) use (&$file_content) {
				$class = str_replace('-', '_', $matches[1]);
				$arguments = str_replace(["\n", "\t"], '', $matches[2]);
				$arguments = explode(' ', $arguments);
				if(is_file("components/{$class}/{$class}.php")) {
					require_once "components/{$class}/{$class}.php";
					/**
					 * @var xphp_tag $tag
					 */
					$tag = new $class();
					foreach ($arguments as $argument) {
						$argument = explode('=', $argument);
						if($argument[0] !== '') {
							if ($argument[0] === 'value') {
								$tag->value($argument[1]);
							} else {
								$tag->attribute($argument[0], $argument[1]);
							}
						}
					}
					$tag->value($matches[3]);
					$file_content = str_replace($matches[0], $tag->render(), $file_content);
				}
			}, $file_content);

			// balises banales sans contenu
			// sans attributs
			preg_replace_callback(regexp::get_regexp_for_no_autoclosed_tags_without_content_and_arguments(), function ($matches) use (&$file_content) {
				$class = str_replace('-', '_', $matches[1]);
				if(is_file("components/{$class}/{$class}.php")) {
					require_once "components/{$class}/{$class}.php";
					/**
					 * @var xphp_tag $tag
					 */
					$tag = new $class();
					$file_content = str_replace($matches[0], $tag->render(), $file_content);
				}
			}, $file_content);
			// sans attributs mais avec un espace
			preg_replace_callback(regexp::get_regexp_for_no_autoclosed_tags_without_content_and_arguments_and_with_spaces(), function ($matches) use (&$file_content) {
				$class = str_replace('-', '_', $matches[1]);
				if(is_file("components/{$class}/{$class}.php")) {
					require_once "components/{$class}/{$class}.php";
					/**
					 * @var xphp_tag $tag
					 */
					$tag = new $class();
					$file_content = str_replace($matches[0], $tag->render(), $file_content);
				}
			}, $file_content);
			// avec attributs
			preg_replace_callback(regexp::get_regexp_for_no_autoclosed_tags_without_content_and_with_arguments(), function ($matches) use (&$file_content) {
				$class = str_replace('-', '_', $matches[1]);
				$arguments = str_replace(["\n", "\t"], '', $matches[2]);
				$arguments = explode(' ', $arguments);
				if(is_file("components/{$class}/{$class}.php")) {
					require_once "components/{$class}/{$class}.php";
					/**
					 * @var xphp_tag $tag
					 */
					$tag = new $class();
					foreach ($arguments as $argument) {
						$argument = explode('=', $argument);
						if($argument[0] !== '') {
							if ($argument[0] === 'value') {
								$tag->value($argument[1]);
							} else {
								$tag->attribute($argument[0], $argument[1]);
							}
						}
					}
					$file_content = str_replace($matches[0], $tag->render(), $file_content);
				}
			}, $file_content);

			// balises autofermantes
			// sans attributs
			preg_replace_callback(regexp::get_regexp_for_autoclosed_tags_without_arguments(), function ($matches) use (&$file_content) {
				$class = str_replace('-', '_', $matches[1]);
				if(is_file("components/{$class}/{$class}.php")) {
					require_once "components/{$class}/{$class}.php";
					/**
					 * @var xphp_tag $tag
					 */
					$tag = new $class();
					$file_content = str_replace($matches[0], $tag->render(), $file_content);
				}
			}, $file_content);
			// sans attributs mais avec un espace
			preg_replace_callback(regexp::get_regexp_for_autoclosed_tags_without_arguments_and_spaces(), function ($matches) use (&$file_content) {
				$class = str_replace('-', '_', $matches[1]);
				if(is_file("components/{$class}/{$class}.php")) {
					require_once "components/{$class}/{$class}.php";
					/**
					 * @var xphp_tag $tag
					 */
					$tag = new $class();
					$file_content = str_replace($matches[0], $tag->render(), $file_content);
				}
			}, $file_content);
			// avec attributs
			preg_replace_callback(regexp::get_regexp_for_autoclosed_tags_with_arguments(), function ($matches) use (&$file_content) {
				$class = str_replace('-', '_', $matches[1]);
				$arguments = str_replace(["\n", "\t"], '', $matches[2]);
				$arguments = explode(' ', $arguments);
				if(is_file("components/{$class}/{$class}.php")) {
					require_once "components/{$class}/{$class}.php";
					/**
					 * @var xphp_tag $tag
					 */
					$tag = new $class();
					foreach ($arguments as $argument) {
						$argument = explode('=', $argument);
						if($argument[0] !== '') {
							if ($argument[0] === 'value') {
								$tag->value($argument[1]);
							} else {
								$tag->attribute($argument[0], $argument[1]);
							}
						}
					}
					$file_content = str_replace($matches[0], $tag->render(), $file_content);
				}
			}, $file_content);

			return $file_content;
		}
		return '';
	}
}