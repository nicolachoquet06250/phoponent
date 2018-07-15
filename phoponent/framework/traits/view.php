<?php

/**
 * © 2018 - Phoponent
 * Author: Nicolas Choquet
 * Email: nicolachoquet06250@gmail.com
 * LICENSE GPL ( GNU General Public License )
 */

namespace phoponent\framework\traits;

use phoponent\framework\static_classe\xphp;

trait view {
    private $template = '';
    protected $vars = [];
    protected $component = '';

    public function __construct($path) {
    	$view_name = explode('\\', get_class($this))[count(explode('\\', get_class($this)))-1];
        if(is_file("{$path}/src/{$view_name}.view.html")) {
            $this->template = file_get_contents("{$path}/src/{$view_name}.view.html");
        }
    }

    public function set_parent($parent_class) {
        if(strstr(__CLASS__, 'custom')) {
            $this->set_vars(['parent' => $parent_class->get_template()]);
        }
    }

    public function set_vars($vars) {
        foreach ($vars as $var => $value) {
            $this->vars[$var] = $value;
        }
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