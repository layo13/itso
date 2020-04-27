<?php

define('ROOT', __DIR__);

require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/vendor/pdo.php';

define('URL', 'http://localhost/itso/');

// -----------------------------------------------------------------------------
// Chargement des applications
// -----------------------------------------------------------------------------
$applications = [
	($admin = new Http\Itso\Admin\AdminApplication('Admin', 'admin', '/admin')),
	($vip = new Http\Itso\Vip\VipApplication('Vip', 'vip', '/vip'))
	//Member
];

$request = new \Epic\Http\Request();
$requestUri = $request->requestUri();

/* @var $application Epic\BaseApplication */
$selectedApplication = null;

/* @var $application Epic\BaseController */
foreach ($applications as $application) {

	if (startsWith($requestUri, $application->getPrefix())) {
		$selectedApplication = $application;
	}
}

if (!is_null($selectedApplication)) {
	$selectedApplication->run($request);
} else {

	throw new Exception('Aucune application ne peut etre lancee');
}
exit;


