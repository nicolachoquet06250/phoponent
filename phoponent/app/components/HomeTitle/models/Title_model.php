<?php
namespace phoponent\app\component\HomeTitle\mvc\model;

use phoponent\framework\traits\model;

class Title_model
{
	use model;
    public function get_title($title) {
        return is_null($title) ? 'Accueil' : $title;
    }
}