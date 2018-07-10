<?php

class xphp_tag {
	protected $attributs = [];
	protected $value = '';
	private $models = [];
    private $views = [];

    public function __construct($models, $views) {
        $this->models = $models;
        $this->views = $views;
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

		$value = str_replace('%20', ' ', $value);
		$this->attributs[$name] = $value;
		return $this;
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
		$value = str_replace('%20', ' ', $value);
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

    public function get_model($name) {
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
        return isset($this->views[$name]) ? $this->views[$name] : null;
    }
}