<?php
namespace phoponent\framework\traits;

trait model {
	private $services = [];
	private $component = '';
    public function __construct($services, string $component) {
        $this->services = $services;
		$this->component = $component;
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

	public function get_component() {
		return $this->component;
	}
}