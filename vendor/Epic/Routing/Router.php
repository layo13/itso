<?php

namespace Epic\Routing;

class Router {

	/**
	 *
	 * @var array 
	 */
	private $routes;

	public function __construct() {
		$this->routes = [];
	}

	public function init($routes) {
		$parameterNameRegex = "[a-z][a-z0-9_]*";
		$endingOptionalParameterRegex = "\/{(" . $parameterNameRegex . ")\?}\$";
		foreach ($routes as $name => $data) {
			$uri = $data['uri'];
			$uris = $matches = [];
			while (preg_match('`' . $endingOptionalParameterRegex . '`', $uri, $matches)) {
				$pattern = $uri;
				if (preg_match_all("`{(" . $parameterNameRegex . ")\\??}`", $uri, $matches)) {
					for ($i = 0; $i < count($matches[0]); ++$i) {
						$match = $matches[0][$i];
						$parameterName = $matches[1][$i];
						if (!empty($data['parameters'][$parameterName])) {
							$pattern = str_replace($match, "(" . $data['parameters'][$parameterName] . ")", $pattern);
						} else {
							$pattern = str_replace($match, "(" . $parameterNameRegex . ")", $pattern);
						}
					}
				}
				$uris[] = $pattern;
				$uri = preg_replace('`' . $endingOptionalParameterRegex . '`', '', $uri);
			}
			$pattern = $uri;
			if (preg_match_all("`{(" . $parameterNameRegex . ")}`", $uri, $matches)) {
				for ($i = 0; $i < count($matches[0]); ++$i) {
					$match = $matches[0][$i];
					$parameterName = $matches[1][$i];
					if (!empty($data['parameters'][$parameterName])) {
						$pattern = str_replace($match, "(" . $data['parameters'][$parameterName] . ")", $pattern);
					} else {
						$pattern = str_replace($match, "(" . $parameterNameRegex . ")", $pattern);
					}
				}
			}
			$uris[] = $pattern;
			$this->addRoute(new \Epic\Routing\Route($name, $data['method'], $data['action'], $data['uri'], $uris));
		}
	}

	public function addRoute(Route $route) {
		array_push($this->routes, $route);
	}

	/**
	 * 
	 * @param string $method
	 * @param string $requestURI
	 * @param array $matches
	 * @return Route
	 * @throws Exception
	 */
	public function getMatchingRoute($method, $requestURI, &$matches) {

		/* @var $route Route */
		foreach ($this->routes as $route) {
			if ($route->match($method, $requestURI, $matches)) {
				return $route;
			}
		}

		throw new Exception("Page not found", 404);
	}

}
