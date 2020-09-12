<?php

define('ROOT', __DIR__);

require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/vendor/pdo.php';

if (php_sapi_name() == "cli") {
    $commandArg = empty($argv[1]) ? null : $argv[1];
} else {
    $commandArg = empty($_GET['command']) ? null : $_GET['command'];
}

if (empty($commandArg)) {
    echo 'Please fill a command name.';
    exit;
} else {
    $commandName = ucfirst(preg_replace_callback('/_([^_])/', function (array $m) {
            return ucfirst($m[1]);
        }, $commandArg));
}

$consoleDir = ROOT . '/app/Console';
$command = null;

foreach (scandir($consoleDir) as $file) {
    if (is_file($filename = $consoleDir . '/' . $file)) {
        
        if ($commandName == pathinfo($filename, PATHINFO_FILENAME)) {
            $pdo = PdoProvider::getInstance();
            $commandClassName = "\\Console\\" . $commandName;
            /** @var Epic\Console\Command $command */
            $command = new $commandClassName($pdo);
            break;
        }
    }
}

if (empty($command)) {
    echo 'No command foud';
} else {
    $command->exec();
}











exit;
if (1 == 2) {
    header('Content-Type: text/html; Charset=UTF-8');
    $pdo = null;
    // en dur pour l'instant
    (new \Console\Migration($pdo))->exec();
    $pdo = PdoProvider::getInstance();

    (new \Console\Filling($pdo))->exec();
    (new \Console\CheckDatabase($pdo))->exec();
} else {
    header('Content-Type: text/html; Charset=UTF-8');
    $pdo = PdoProvider::getInstance();
    (new Console\Faker($pdo))->exec();


    /* $pdo = PdoProvider::getInstance();
      $products = $pdo->query(<<<SQL
      SELECT DISTINCTROW product.name as 'product.name', picture.name as 'picture.name', product_link.url as 'product_link.url'
      FROM product
      INNER JOIN product_picture ON (product_picture.product_id = product.id)
      INNER JOIN picture ON (product_picture.picture_id = picture.id)
      INNER JOIN product_link ON (product_link.product_id = product.id)
      SQL
      )->fetchAll();

      $filename = ROOT . '/db/products_ebay.json';
      !is_file($filename) or unlink($filename);
      $json = [];

      foreach ($products as $product) {


      $data = file_get_contents(ROOT . '/public/assets/images/product/' . $product['picture.name']);
      $base64 = 'data:image/jpg;base64,' . base64_encode($data);

      $json[] = [
      'name' => $product['product.name'],
      'picture' => $base64,
      'url' => $product['product_link.url']
      ];
      continue;
      }

      file_put_contents($filename, json_encode($json, JSON_PRETTY_PRINT)); */
}