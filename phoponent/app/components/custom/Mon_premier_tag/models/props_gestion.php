<?php
namespace phoponent\app\component\custom\Mon_premier_tag\mvc\model;

use phoponent\framework\traits\model;

class props_gestion extends \phoponent\app\component\core\Mon_premier_tag\mvc\model\props_gestion {
    use model;

    private $id, $class, $value;

    public function set($name, $value) {
        $prop = "set_{$name}";
        $this->$prop($value);
        return $this;
    }

    public function get($name) {
        $prop = "get_{$name}";
        return $this->$prop();
    }

    private function set_id($id) {
        $this->id = $id;
    }

    private function set_class($class) {
        $this->class = $class;
    }

    private function set_value($value) {
        $this->value = $value;
    }

    private function get_infos() {
        $content = $this->value;
        $id = '';
        $class = '';
        if(!is_null($this->id)) {
            $id = " id='{$this->id}'";
        }
        if(!is_null($this->class)) {
            $class = " class='{$this->class}'";
        }

        return [$class, $id, $content];
    }
}