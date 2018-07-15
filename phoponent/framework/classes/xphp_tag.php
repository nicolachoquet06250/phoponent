<?php

/**
 * © 2018 - Phoponent
 * Author: Nicolas Choquet
 * Email: nicolachoquet06250@gmail.com
 * LICENSE GPL ( GNU General Public License )
 */

namespace phoponent\framework\classe;

use phoponent\framework\traits\model;
use phoponent\framework\traits\view;
use phoponent\loading\Auto;

class xphp_tag {
	protected $attributs = [];
	protected $value = '';
	private $models = [];
    private $views = [];
    private $services = [];
    private $styles = [];
    protected $template = '';

    public function __construct($models, $views, $services, &$template) {
        $this->models = $models;
        $this->views = $views;
        $this->services = $services;
        $this->template = $template;
    }

    public static function load_services() {
        return Auto::dependencie('services');
    }

    public function attribute($name=null, $value=null) {
		if(is_null($value)) {
			if(is_null($name)) {
				return $this->attributs;
			}
			return isset($this->attributs[$name]) ? $this->attributs[$name] : null;
		}

		if((substr($value, 0, 1) === '"' || substr($value, 0, 1) === "'" )
		   && (substr($value, strlen($value)-1, 1) === '"' || substr($value, strlen($value)-1, 1) === "'" )) {
			$value = substr($value, 1, strlen($value));
			$value = substr($value, 0, strlen($value)-1);
		}

		$this->attributs[$name] = $value;
		return $this;
	}

	protected function set_style($selector, $styles) {
    	$this->styles[$selector] = $styles;
	}

	protected function get_style() {
    	return $this->styles;
	}

	protected function add_style_to_page() {
    	//TODO incruster le style du composant dans le template de base
    	return $this->template;
	}

	public function value($value = null) {
		if(is_null($value)) {
			return $this->value;
		}
		if((substr($value, 0, 1) === '"' || substr($value, 0, 1) === "'" )
		   && (substr($value, strlen($value)-1, 1) === '"' || substr($value, strlen($value)-1, 1) === "'" )) {
			$value = substr($value, 1, strlen($value));
			$value = substr($value, 0, strlen($value)-1);
		}

		$this->value = $value;
		return $this;
	}

	public function render():string {
		return '';
	}

	public function get_class() {
		return __CLASS__;
	}

	protected function get_models() {
	    return array_keys($this->models);
    }

	/**
	 * @param $name
	 * @return model
	 */
    public function get_model($name) {
		$name = "{$name}";
        return isset($this->models[$name]) ? $this->models[$name] : null;
    }

    public function get_views() {
	    return array_keys($this->views);
    }

    /**
     * @param $name
     * @return view
     */
    public function get_view($name) {
    	$name = "{$name}";
        return isset($this->views[$name]) ? $this->views[$name] : null;
    }

	public function get_services() {
		return array_keys($this->services);
	}

	public function get_service($name) {
		return isset($this->services[$name]) ? $this->services[$name] : null;
	}
}