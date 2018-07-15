<?php

/**
 * © 2018 - Phoponent
 * Author: Nicolas Choquet
 * Email: nicolachoquet06250@gmail.com
 * LICENSE GPL ( GNU General Public License )
 */

namespace phoponent;
require_once 'phoponent/Autoload.php';
loading\Auto::load();

echo index::start(!isset($argv) ? [1 => $_GET['p']] : $argv);