<?php

class Title
{
    public function get_title($title) {
        return is_null($title) ? 'Accueil' : $title;
    }
}