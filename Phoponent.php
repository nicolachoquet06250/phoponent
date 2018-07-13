#!/usr/bin/env php
<?php

require "phoponent/Autoload.php";
	\phoponent\loading\Auto::load();
	try {
        \phoponent\framework\static_classe\command::go($argv);
	}
	catch (Exception $e) {
		exit($e->getMessage()."\n");
	}