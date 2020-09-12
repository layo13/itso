<?php
setlocale(LC_TIME, "fr_FR");

define('ROOT', __DIR__);

require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/vendor/pdo.php';

// CHOIX DE LA CONFIG

use Epic\Config;

$scandirConfig = scandir($configDirname = ROOT . '/config');
foreach ($scandirConfig as $configFile) {

	if (!is_file($configFilename = $configDirname . "/" . $configFile)) {
		continue;
	}

	$configTest = new Config(pathinfo($configFilename, PATHINFO_FILENAME));
	$configTest->setValues(require $configFilename);

	if ($_SERVER['HTTP_HOST'] == $configTest->getValue(Config::HTTP_HOST)) {
		$config = $configTest;
		break;
	}
}

if (empty($config)) {
	$config = new Config('default');
}

define('URL', $config->getValue(Config::URL));
PdoProvider::$dbname = $config->getValue(Config::DB_NAME);
PdoProvider::$host = $config->getValue(Config::DB_HOST);
PdoProvider::$user = $config->getValue(Config::DB_USER);
PdoProvider::$password = $config->getValue(Config::DB_PASSWORD);
PdoProvider::$port = $config->getValue(Config::DB_PORT);

// -----------------------------------------------------------------------------
// Chargement des applications
// -----------------------------------------------------------------------------
$applications = [
	($admin = new Http\Itso\Admin\AdminApplication('Admin', 'admin', '/admin')),
	($vip = new Http\Itso\Vip\VipApplication('Vip', 'vip', '/vip')),
	($front = new \Http\Itso\Front\FrontApplication('Front', 'front'))
];

$request = new \Epic\Http\Request();
$requestUri = $request->requestUri();

/* @var $application Epic\BaseApplication */
$selectedApplication = null;

/* @var $application Epic\BaseController */
foreach ($applications as $application) {
	if (startsWith($requestUri, $application->getPrefix())) {
		$selectedApplication = $application;
        break;
	}
}

if (!is_null($selectedApplication)) {
	$selectedApplication->run($request);
} else {
	throw new Exception('Aucune application ne peut etre lancee');
}

exit;
