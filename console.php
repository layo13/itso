<?php

define('ROOT', __DIR__);

require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/vendor/pdo.php';

header('Content-Type: text/html; Charset=UTF-8');

$pdo = null;

// en dur pour l'instant
(new \Console\Migration($pdo))->exec();

$pdo = PdoProvider::getInstance();

(new \Console\Filling($pdo))->exec();
(new \Console\CheckDatabase($pdo))->exec();