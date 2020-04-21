<?php

define('ROOT', __DIR__);

require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/vendor/pdo.php';

$pdo = PdoProvider::getInstance();

header('Content-Type: text/html; Charset=UTF-8');

// en dur pour l'instant
(new \Console\Migration($pdo))->exec();
(new \Console\Filling($pdo))->exec();
(new \Console\CheckDatabase($pdo))->exec();