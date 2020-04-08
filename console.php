<?php

define('ROOT', __DIR__);

require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/vendor/pdo.php';

$pdo = PdoItsof::getInstance();


// en dur pour l'instant
(new \Console\Migration($pdo))->exec();
(new \Console\Filling($pdo))->exec();
