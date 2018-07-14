<?php
namespace phoponent\framework\static_classe;

use phoponent\framework\classe\xphp_tag;
use phoponent\framework\traits\static_class;
use phoponent\loading\Auto;

class xphp {
    use static_class;

    public static function get_models($component, $type = 'core') {
        $models = [];
        $dir = opendir("phoponent/app/components/{$type}/{$component}/models");
        while (($file = readdir($dir)) !== false) {
            if($file !== '.' && $file !== '..') {
                if(is_file("phoponent/app/components/custom/{$component}/models/{$file}")) {
                    require_once "phoponent/app/components/core/{$component}/models/{$file}";
                    require_once "phoponent/app/components/custom/{$component}/models/{$file}";
                    $class_tag = "\phoponent\app\component\custom\{$component}";
                    $model = str_replace('.php', '', $file);
                    $model_class = "\\phoponent\\app\\component\\custom\\$component\\mvc\\model\\$model";
                    $models[$model] = new $model_class(self::get_services($class_tag), $component);
                }
                elseif(is_file("phoponent/app/components/core/{$component}/models/{$file}")) {
                    require_once "phoponent/app/components/core/{$component}/models/{$file}";
                    $class_tag = "\phoponent\app\component\core\{$component}";
                    $model = str_replace('.php', '', $file);
                    $model_class = "\\phoponent\\app\\component\\core\\$component\\mvc\\model\\$model";
                    $models[$model] = new $model_class(self::get_services($class_tag), $component);
                }
            }
        }
        return $models;
    }

    public static function get_views($component, $type = 'core') {
        $views = [];
        $dir = opendir("phoponent/app/components/{$type}/{$component}/views");
        while (($file = readdir($dir)) !== false) {
            if($file !== '.' && $file !== '..') {
                if(is_file("phoponent/app/components/custom/{$component}/views/{$file}")) {
                    require_once "phoponent/app/components/core/{$component}/views/{$file}";
                    require_once "phoponent/app/components/custom/{$component}/views/{$file}";
                    $view = str_replace('.view.php', '', $file);
                    $view_class = "\\phoponent\\app\\component\\custom\\$component\\mvc\\view\\$view";
                    $views[$view] = new $view_class("phoponent/app/components/custom/{$component}/views");
                }
                elseif(is_file("phoponent/app/components/core/{$component}/views/{$file}")) {
                    require_once "phoponent/app/components/core/{$component}/views/{$file}";
                    $view = str_replace('.view.php', '', $file);
                    $view_class = "\\phoponent\\app\\component\\core\\$component\\mvc\\view\\$view";
                    $views[$view] = new $view_class("phoponent/app/components/core/{$component}/views");
                }
            }
        }
        return $views;
    }

    public static function get_services($component) {
		$services = [];
		$component = str_replace(['{', '}'], '', $component);
        foreach ($component::load_services() as $name => $service_to_load) {
            if($service_to_load !== null) {
                if (is_file($service_to_load['path'])) {
                    Auto::dependencie('services', explode('\\', $service_to_load['class'])[count(explode('\\', $service_to_load['class'])) - 1]);
                    $class = '\\' . $service_to_load['class'];
                    $services[$name] = new $class();
                }
            }
		}
		return $services;
	}

    private static function clean_path($path) {
		if(substr($path, 0, 11) !== '/phoponent' && substr($path, 0, 11) !== 'phoponent/') {
			$path = str_replace('index.php/', '', $path);
			if (strstr($path, 0, 1) === '/') {
				$path = 'phoponent/app' . $path;
			} elseif (strstr($path, 0, 1) !== '/') {
				$path = 'phoponent/app/' . $path;
			}

			if (!strstr($path, '.') && substr($path, strlen($path) - 1, 1) !== '/') {
				$path .= '/index.html';
			} elseif (!strstr($path, '.') && substr($path, strlen($path) - 1, 1) === '/') {
				$path .= 'index.html';
			}
		}
		return $path;
	}

	public static function parse($path) {
        $path = self::clean_path($path);

		if(is_file($path)) {
            $file_content = file_get_contents($path);
		    if(explode('.', $path)[count(explode('.', $path))-1] === 'php') {
		        $file_content = include $path;
            }
            self::parse_template_content($file_content);
			return $file_content;
		}
		return '';
	}

	public static function parse_template_content(&$template) {
		// balise banales avec contenu
		// sans attributs
		preg_replace_callback(regexp::get_regexp_for_no_autoclosed_tags_with_content_and_not_arguments(), function ($matches) use (&$template) {
			$class = str_replace('-', '_', $matches[1]);
			if(is_file("phoponent/app/components/custom/{$class}/{$class}.php")) {
			    require_once "phoponent/app/components/core/{$class}/{$class}.php";
				require_once "phoponent/app/components/custom/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\custom\\$class";
				/**
				 * @var xphp_tag $tag
				 */
				$tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
				$tag->value($matches[2]);
				$template = str_replace($matches[0], $tag->render(), $template);
			}
			elseif(is_file("phoponent/app/components/core/{$class}/{$class}.php")) {
                require_once "phoponent/app/components/core/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\core\\$class";
                /**
                 * @var xphp_tag $tag
                 */
                $tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
                $tag->value($matches[2]);
                $template = str_replace($matches[0], $tag->render(), $template);
            }
		}, $template);
		// sans attributs mais avec un espace
		preg_replace_callback(regexp::get_regexp_for_no_autoclosed_tags_with_content_and_not_arguments_and_spaces(), function ($matches) use (&$template) {
			$class = str_replace('-', '_', $matches[1]);
			if(is_file("phoponent/app/components/custom/{$class}/{$class}.php")) {
				require_once "phoponent/app/components/core/{$class}/{$class}.php";
                require_once "phoponent/app/components/custom/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\custom\\$class";
				/**
				 * @var xphp_tag $tag
				 */
				$tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
				$tag->value($matches[2]);
				$template = str_replace($matches[0], $tag->render(), $template);
			}
			elseif (is_file("phoponent/app/components/core/{$class}/{$class}.php")) {
                require_once "phoponent/app/components/core/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\core\\$class";
                /**
                 * @var xphp_tag $tag
                 */
                $tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
                $tag->value($matches[2]);
                $template = str_replace($matches[0], $tag->render(), $template);
            }
		}, $template);
		// avec attributs
		preg_replace_callback(regexp::get_regexp_for_no_autoclosed_tags_with_content_and_arguments(), function ($matches) use (&$template) {
			$class = str_replace('-', '_', $matches[1]);

			$arguments = str_replace(["\n", "\t"], '', $matches[2]);
            $arguments_array = [];
            preg_replace_callback(regexp::regexp_for_parse_attributs(), function ($matches) use (&$arguments_array) {
                $arguments_array[] = $matches[1];
            }, $arguments);
            preg_replace_callback(regexp::regexp_for_parse_attributs_with_only_integers(), function ($matches) use (&$arguments_array) {
                $arguments_array[] = $matches[1];
            }, $arguments);
            foreach ($arguments_array as $id => $arg) {
                $arg_local = explode('=', $arg);
                $argument = $arg_local[0];
                $valeur = str_replace('\"', 'µ', $arg_local[1]);
                $valeur = str_replace('"', '', $valeur);
                $valeur = str_replace('µ', '"', $valeur);

                $arguments_array[$argument] = $valeur;
                unset($arguments_array[$id]);
            }
            $arguments_array['value'] = $matches[3];
            $arguments = $arguments_array;

            if(is_file("phoponent/app/components/custom/{$class}/{$class}.php")) {
                require_once "phoponent/app/components/core/{$class}/{$class}.php";
                require_once "phoponent/app/components/custom/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\custom\\$class";
                /**
                 * @var xphp_tag $tag
                 */
                $tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
                foreach ($arguments as $argument => $valeur) {
                    if ($argument === 'value') {
                        $tag->value($valeur);
                    } else {
                        $tag->attribute($argument, $valeur);
                    }
                }
                $template = str_replace($matches[0], $tag->render(), $template);
            }
            elseif (is_file("phoponent/app/components/core/{$class}/{$class}.php")) {
                require_once "phoponent/app/components/core/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\core\\$class";
                /**
                 * @var xphp_tag $tag
                 */
                $tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
                foreach ($arguments as $argument => $valeur) {
                    if ($argument === 'value') {
                        $tag->value($valeur);
                    } else {
                        $tag->attribute($argument, $valeur);
                    }
                }
                $template = str_replace($matches[0], $tag->render(), $template);
            }
		}, $template);

		// balises banales sans contenu
		// sans attributs
		preg_replace_callback(regexp::get_regexp_for_no_autoclosed_tags_without_content_and_arguments(), function ($matches) use (&$template) {
			$class = str_replace('-', '_', $matches[1]);
			if(is_file("phoponent/app/components/custom/{$class}/{$class}.php")) {
				require_once "phoponent/app/components/core/{$class}/{$class}.php";
                require_once "phoponent/app/components/custom/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\custom\\$class";
				/**
				 * @var xphp_tag $tag
				 */
				$tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
				$template = str_replace($matches[0], $tag->render(), $template);
			}
			elseif(is_file("phoponent/app/components/core/{$class}/{$class}.php")) {
                require_once "phoponent/app/components/core/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\core\\$class";
                /**
                 * @var xphp_tag $tag
                 */
                $tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
                $template = str_replace($matches[0], $tag->render(), $template);
            }
		}, $template);
		// sans attributs mais avec un espace
		preg_replace_callback(regexp::get_regexp_for_no_autoclosed_tags_without_content_and_arguments_and_with_spaces(), function ($matches) use (&$template) {
			$class = str_replace('-', '_', $matches[1]);
			if(is_file("phoponent/app/components/custom/{$class}/{$class}.php")) {
				require_once "phoponent/app/components/core/{$class}/{$class}.php";
                require_once "phoponent/app/components/custom/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\custom\\$class";
				/**
				 * @var xphp_tag $tag
				 */
				$tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
				$template = str_replace($matches[0], $tag->render(), $template);
			}
			elseif(is_file("phoponent/app/components/core/{$class}/{$class}.php")) {
                require_once "phoponent/app/components/core/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\core\\$class";
                /**
                 * @var xphp_tag $tag
                 */
                $tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
                $template = str_replace($matches[0], $tag->render(), $template);
            }
		}, $template);
		// avec attributs
		preg_replace_callback(regexp::get_regexp_for_no_autoclosed_tags_without_content_and_with_arguments(), function ($matches) use (&$template) {
			$class = str_replace('-', '_', $matches[1]);
			$arguments = str_replace(["\n", "\t"], '', $matches[2]);
            $arguments_array = [];
            preg_replace_callback(regexp::regexp_for_parse_attributs(), function ($matches) use (&$arguments_array) {
                $arguments_array[] = $matches[1];
            }, $arguments);

            preg_replace_callback(regexp::regexp_for_parse_attributs_with_only_integers(), function ($matches) use (&$arguments_array) {
                $arguments_array[] = $matches[1];
            }, $arguments);

            foreach ($arguments_array as $id => $arg) {
                $arg_local = explode('=', $arg);
                $argument = $arg_local[0];
                $valeur = str_replace('\"', 'µ', $arg_local[1]);
                $valeur = str_replace('"', '', $valeur);
                $valeur = str_replace('µ', '"', $valeur);

                $arguments_array[$argument] = $valeur;
                unset($arguments_array[$id]);
            }

            $arguments = $arguments_array;
            if(is_file("phoponent/app/components/custom/{$class}/{$class}.php")) {
                require_once "phoponent/app/components/core/{$class}/{$class}.php";
                require_once "phoponent/app/components/custom/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\custom\\$class";
                /**
                 * @var xphp_tag $tag
                 */
                $tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
                foreach ($arguments as $argument => $valeur) {
                    if ($argument === 'value') {
                        $tag->value($valeur);
                    } else {
                        $tag->attribute($argument, $valeur);
                    }
                }
                $template = str_replace($matches[0], $tag->render(), $template);
            }
            elseif(is_file("phoponent/app/components/core/{$class}/{$class}.php")) {
                require_once "phoponent/app/components/core/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\core\\class";
                /**
                 * @var xphp_tag $tag
                 */
                $tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
                foreach ($arguments as $argument => $valeur) {
                    if ($argument === 'value') {
                        $tag->value($valeur);
                    } else {
                        $tag->attribute($argument, $valeur);
                    }
                }
                $template = str_replace($matches[0], $tag->render(), $template);
            }
		}, $template);

		// balises autofermantes
		// sans attributs
		preg_replace_callback(regexp::get_regexp_for_autoclosed_tags_without_arguments(), function ($matches) use (&$template) {
			$class = str_replace('-', '_', $matches[1]);
			if(is_file("phoponent/app/components/custom/{$class}/{$class}.php")) {
				require_once "phoponent/app/components/core/{$class}/{$class}.php";
                require_once "phoponent/app/components/custom/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\custom\\$class";
				/**
				 * @var xphp_tag $tag
				 */
				$tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
				$template = str_replace($matches[0], $tag->render(), $template);
			}
			elseif(is_file("phoponent/app/components/core/{$class}/{$class}.php")) {
                require_once "phoponent/app/components/core/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\core\\$class";
                /**
                 * @var xphp_tag $tag
                 */
                $tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
                $template = str_replace($matches[0], $tag->render(), $template);
            }
		}, $template);
		// sans attributs mais avec un espace
		preg_replace_callback(regexp::get_regexp_for_autoclosed_tags_without_arguments_and_spaces(), function ($matches) use (&$template) {
			$class = str_replace('-', '_', $matches[1]);
			if(is_file("phoponent/app/components/custom/{$class}/{$class}.php")) {
				require_once "phoponent/app/components/core/{$class}/{$class}.php";
                require_once "phoponent/app/components/custom/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\custom\\$class";
				/**
				 * @var xphp_tag $tag
				 */
				$tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
				$template = str_replace($matches[0], $tag->render(), $template);
			}
			elseif(is_file("phoponent/app/components/core/{$class}/{$class}.php")) {
                require_once "phoponent/app/components/core/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\core\\$class";
                /**
                 * @var xphp_tag $tag
                 */
                $tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
                $template = str_replace($matches[0], $tag->render(), $template);
            }
		}, $template);
		// avec attributs
		preg_replace_callback(regexp::get_regexp_for_autoclosed_tags_with_arguments(), function ($matches) use (&$template) {
			$class = str_replace('-', '_', $matches[1]);
			$arguments = str_replace(["\n", "\t"], '', $matches[2]);
            $arguments_array = [];
            preg_replace_callback(regexp::regexp_for_parse_attributs(), function ($matches) use (&$arguments_array) {
                $arguments_array[] = $matches[1];
            }, $arguments);

            preg_replace_callback(regexp::regexp_for_parse_attributs_with_only_integers(), function ($matches) use (&$arguments_array) {
                $arguments_array[] = $matches[1];
            }, $arguments);

            foreach ($arguments_array as $id => $arg) {
                $arg_local = explode('=', $arg);
                $argument = $arg_local[0];
                $valeur = str_replace('\"', 'µ', $arg_local[1]);
                $valeur = str_replace('"', '', $valeur);
                $valeur = str_replace('µ', '"', $valeur);

                $arguments_array[$argument] = $valeur;
                unset($arguments_array[$id]);
            }

            $arguments = $arguments_array;
			if(is_file("phoponent/app/components/custom/{$class}/{$class}.php")) {
				require_once "phoponent/app/components/core/{$class}/{$class}.php";
                require_once "phoponent/app/components/custom/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\custom\\$class";
				/**
				 * @var xphp_tag $tag
				 */
				$tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
				foreach ($arguments as $argument => $valeur) {
					if ($argument === 'value') {
					    $tag->value($valeur);
					} else {
					    $tag->attribute($argument, $valeur);
					}
				}
				$template = str_replace($matches[0], $tag->render(), $template);
			}
			elseif(is_file("phoponent/app/components/core/{$class}/{$class}.php")) {
                require_once "phoponent/app/components/core/{$class}/{$class}.php";
                $class_tag = "\\phoponent\\app\\component\\core\\$class";
                /**
                 * @var xphp_tag $tag
                 */
                $tag = new $class_tag(self::get_models($class), self::get_views($class), self::get_services($class_tag), $template);
                foreach ($arguments as $argument => $valeur) {
                    if ($argument === 'value') {
                        $tag->value($valeur);
                    } else {
                        $tag->attribute($argument, $valeur);
                    }
                }
                $template = str_replace($matches[0], $tag->render(), $template);
            }
		}, $template);
	}
}