<?php

require_once __DIR__ . '/Epic/EpicLoader.php';
EpicLoader::register();

spl_autoload_register(function($class) {
	$file = str_replace("\\", "/", ROOT . "/app/" . $class . ".php");
	if (is_file($file)) {
		require $file;
	} else {
		return;
	}
});
