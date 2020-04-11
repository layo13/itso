<?php

namespace Epic;

use Epic\Http\Request;
use Epic\Routing\Router;

abstract class BaseApplication {

	protected $name;
	protected $reference;
	protected $prefix;
	// ---
	
	/**
	 *
	 * @var User 
	 */
	protected $user;
	protected $request;
	protected $router;

	public function __construct($name, $reference, $prefix = '') {
		$this->user = new User($this);
		$this->request = new Request();

		$this->name = $name;
		$this->reference = $reference;
		$this->prefix = $prefix;
	}

	protected function getControllerAction() {
		$router = new Router();
		$routes = require ROOT . '/routes/' . $this->reference . '.php';
		$applicationRoutes = [];

		foreach ($routes as $name => $route) {

			if (!empty($this->prefix)) {
				$route['uri'] = $this->prefix . $route['uri'];
			}

			$applicationRoutes[$this->reference . '_' . $name] = $route;
		}

		$router->init($applicationRoutes);

		$matches = [];

		/* @var $route \Epic\Routing\Route */
		$route = $router->getMatchingRoute($this->request->requestMethod(), $this->request->requestUri(), $matches);

		list($controllerName, $action) = $route->getAction();

		return [$controllerName, $action, $matches];

		/* if (is_callable($action)) {

		  echo call_user_func_array($action, $matches);
		  exit;
		  } else if (is_array($action)) {
		  $controllerName = $action[0];
		  $controllerMethod = $action[1] . "Action";
		  $controller = new $controllerName($pdo);
		  echo call_user_func_array([$controller, $controllerMethod], $matches);
		  exit;
		  } else {
		  throw new Exception("No valid action");
		  } */
	}

	public function getName() {
		return $this->name;
	}

	public function getReference() {
		return $this->reference;
	}

	public function getPrefix() {
		return $this->prefix;
	}

	/**
	 * 
	 * @return User
	 */
	public function user() {
		return $this->user;
	}

	/**
	 * 
	 * @return Request
	 */
	public function request() {
		return $this->request;
	}

}
