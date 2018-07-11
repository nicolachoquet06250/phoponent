<?php

trait model {
	private $services = [];
    public function __construct($services) {
		$this->services = $services;
    }

    protected function get_services() {
    	return $this->services;
	}

	/**
	 * @param $name
	 * @return service|null
	 */
	protected function get_service($name) {
    	return isset($this->services[$name]) ? $this->services[$name] : null;
	}
}