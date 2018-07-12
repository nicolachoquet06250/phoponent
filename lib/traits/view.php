<?php

trait view {
    private $template = '';
    protected $vars = [];

    public function __construct($path) {
        if(is_file($path.'/src/'.get_class($this).'.view.html')) {
            $this->template = xphp::parse($path.'/src/'.get_class($this).'.view.html');
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