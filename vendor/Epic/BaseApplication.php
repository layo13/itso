<?php

namespace Epic;

use Epic\Http\Request;
use Epic\Routing\Router;

abstract class BaseApplication {

	protected $name;
	protected $reference;
	protected $prefix;
	protected $routeName;
	// ---

	/**
	 *
	 * @var User 
	 */
	protected $user;
	protected $request;

	/**
	 *
	 * @var Router 
	 */
	protected $router;

	public function __construct($name, $reference, $prefix = '') {
		$this->user = new User($this);
		$this->request = new Request();
		$this->router = new Router();

		$this->name = $name;
		$this->reference = $reference;
		$this->prefix = $prefix;
		$this->routeName = NULL;

		$applicationRoutes = [];

		$routesDir = ROOT . '/routes';
		$scandir = scandir($routesDir);
		foreach ($scandir as $e) {
			$filename = $routesDir . '/' . $e;
			if (!is_file($filename) || $this->reference != pathinfo($filename, PATHINFO_FILENAME))continue;

			//$routes = require ROOT . '/routes/' . $this->reference . '.php';
			$routes = require $filename;

			foreach ($routes as $name => $route) {
				if (!empty($this->prefix)) {
					$route['uri'] = $this->prefix . $route['uri'];
				}
				$applicationRoutes[pathinfo($filename, PATHINFO_FILENAME) . '_' . $name] = $route;
			}
		}

		$this->router->init($applicationRoutes);
	}

	protected function getControllerAction() {

		$matches = [];

		/* @var $route \Epic\Routing\Route */
		$route = $this->router->getMatchingRoute($this->request->requestMethod(), $this->request->requestUri(), $matches);

		$this->routeName = $route->getName();

		list($controllerName, $action) = $route->getAction();

		return [$controllerName, $action, $matches];
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

	/**
	 * 
	 * @return Router
	 */
	public function router() {
		return $this->router;
	}

	/**
	 * 
	 * @return string
	 */
	public function routeName() {
		return $this->routeName;
	}

	/**
	 * 
	 * @return \PDO
	 */
	public function pdo() {
		return \PdoProvider::getInstance();
	}

}
