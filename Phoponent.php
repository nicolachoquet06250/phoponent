#!/usr/bin/env php
<?php

use \phoponent\framework\static_classe\command;

require "phoponent/Autoload.php";
	\phoponent\loading\Auto::load();
	try {
		command::go($argv);
	}
	catch (Exception $e) {
		exit($e->getMessage()."\n");
	}