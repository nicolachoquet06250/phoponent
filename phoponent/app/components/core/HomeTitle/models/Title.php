<?php
namespace phoponent\app\component\core\HomeTitle\mvc\model;

use phoponent\framework\traits\model;

class Title
{
	use model;
    public function get_title($title) {
        return is_null($title) ? 'Accueil' : $title;
    }
}