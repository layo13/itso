<?php

define('ROOT', __DIR__);

//echo '<pre>'.($hash = password_hash("test", PASSWORD_DEFAULT)).'</pre>';
//var_dump(password_verify("test", $hash));exit;

require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/vendor/pdo.php';

// -----------------------------------------------------------------------------
// Chargement des applications
// -----------------------------------------------------------------------------
$applications = [
	($admin = new Http\Itso\Admin\AdminApplication('Admin', 'admin', '/admin'))
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


