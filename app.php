<?php

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

define('ROOT', __DIR__);

require_once ROOT . '/vendor/autoload.php';

$routes = require_once ROOT . '/routing/routes.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestURI = str_replace('/itso/', '/', $_SERVER['REQUEST_URI']);

$matches = [];

$router = new Epic\Routing\Router();
$router->init($routes);
/* @var $route \Epic\Routing\Route */
$route = $router->getMatchingRoute($requestMethod, $requestURI, $matches);

$action = $route->getAction();

if (is_callable($action)) {

	echo call_user_func_array($action, $matches);
	exit;
} else if (is_array($action)) {
	$controllerName = $action[0];
	$controllerMethod = $action[1] . "Action";
	$controller = new $controllerName();
	echo call_user_func_array([$controller, $controllerMethod], $matches);
	exit;
} else {
	throw new Exception("No valid action");
}
