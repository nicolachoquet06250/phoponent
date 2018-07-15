<?php

//ini_set('display_errors', 'on');
require_once 'phoponent/Autoload.php';
\phoponent\loading\Auto::load();

echo index::start(!isset($argv) ? [1 => $_GET['p']] : $argv);