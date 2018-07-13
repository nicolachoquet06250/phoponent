<?php
namespace phoponent\framework\traits;

use phoponent\framework\static_classe\xphp;

trait view {
    private $template = '';
    protected $vars = [];

    public function __construct($path) {
    	$view_name = explode('\\', get_class($this))[count(explode('\\', get_class($this)))-1];
        if(is_file("{$path}/src/{$view_name}.view.html")) {
            $this->template = file_get_contents("{$path}/src/{$view_name}.view.html");
        }
    }

    public function set_vars($vars) {
        $this->vars = $vars;
        return $this;
    }

    public function get_template():string {
        return $this->template;
    }

    public function before_render() {}

	protected function render_end(&$template) {
		xphp::parse_template_content($template);
	}

    public function render():string {
        $this->before_render();
        $template = $this->get_template();
        foreach ($this->vars as $var => $value) {
            $template = str_replace("@{$var}@", $value, $template);
        }
        $this->render_end($template);
        return $template;
    }
}