<?php
namespace phoponent\app\component\custom\Clock\mvc\model;
use \phoponent\framework\traits\model;

class first extends \phoponent\app\component\core\Clock\mvc\model\first {
    use model;
    public function echo_toto() {
        echo 'toto';
    }
}