<?php
namespace phoponent\app\component\custom\Clock\mvc\view;

use phoponent\framework\traits\view;

class horloge extends \phoponent\app\component\core\Clock\mvc\view\horloge {
    use view;
    public function before_render() {
        $this->set_vars([
            'date' => date('d/m/Y'),
            'heure' => date('H:i'),
        ]);
    }
}