<?php

namespace Epic\Routing;

class Router {

	const PARAMETER_NAME_REGEX = "[a-z][a-z0-9_]*";

	/**
	 *
	 * @var array 
	 */
	private $routes;

	public function __construct() {
		$this->routes = [];
	}

	public function init($routes) {
		$endingOptionalParameterRegex = "\/{(" . self::PARAMETER_NAME_REGEX . ")\?}\$";
		foreach ($routes as $name => $data) {
			$uri = $data['uri'];
			$uris = $matches = [];
			while (preg_match('`' . $endingOptionalParameterRegex . '`', $uri, $matches)) {
				$pattern = $uri;
				if (preg_match_all("`{(" . self::PARAMETER_NAME_REGEX . ")\\??}`", $uri, $matches)) {
					for ($i = 0; $i < count($matches[0]); ++$i) {
						$match = $matches[0][$i];
						$parameterName = $matches[1][$i];
						if (!empty($data['parameters'][$parameterName])) {
							$pattern = str_replace($match, "(" . $data['parameters'][$parameterName] . ")", $pattern);
						} else {
							$pattern = str_replace($match, "(" . self::PARAMETER_NAME_REGEX . ")", $pattern);
						}
					}
				}
				$uris[] = $pattern;
				$uri = preg_replace('`' . $endingOptionalParameterRegex . '`', '', $uri);
			}
			$pattern = $uri;
			if (preg_match_all("`{(" . self::PARAMETER_NAME_REGEX . ")}`", $uri, $matches)) {
				for ($i = 0; $i < count($matches[0]); ++$i) {
					$match = $matches[0][$i];
					$parameterName = $matches[1][$i];
					if (!empty($data['parameters'][$parameterName])) {
						$pattern = str_replace($match, "(" . $data['parameters'][$parameterName] . ")", $pattern);
					} else {
						$pattern = str_replace($match, "(" . self::PARAMETER_NAME_REGEX . ")", $pattern);
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

	public function addRoutes($application, array $routes) {
		var_dump($application, $routes);
	}

	public function getRoute($name, $parameters = []) {
		/* @var $route Route */
		foreach ($this->routes as $route) {

			$nonOptionnalParameterRegex = "`{(" . self::PARAMETER_NAME_REGEX . ")}`";
			$optionnalParameterRegex = "`{(" . self::PARAMETER_NAME_REGEX . ")\\?}`";

			if ($route->getName() == $name) {
				$uri = $route->getUri();

				$nonOptionnalParameters = $optionnalParameters = $matches = [];

				if (0 < preg_match_all($nonOptionnalParameterRegex, $uri, $matches)) {
					$nonOptionnalParameters = $matches[1];
				}

				if (0 < preg_match_all($optionnalParameterRegex, $uri, $matches)) {
					$optionnalParameters = $matches[1];
				}

				if (!empty($nonOptionnalParameters)) {
					foreach ($nonOptionnalParameters as $nonOptionnalParameter) {
						if (empty($parameters[$nonOptionnalParameter])) {
							throw new MissingRouteParameterException('Parameters ' . implode(", ", $nonOptionnalParameters) . ' are required on route ' . $route->getName());
						} else {
							$uri = str_replace('{' . $nonOptionnalParameter . '}', $parameters[$nonOptionnalParameter], $uri);
						}
					}
				}
				if (!empty($optionnalParameters)) {
					foreach ($optionnalParameters as $optionnalParameter) {
						if (!empty($parameters[$optionnalParameter])) {
							$uri = str_replace('{' . $optionnalParameter . '?}', $parameters[$optionnalParameter], $uri);
						}
					}
				}

				$endingOptionalParameterRegex = "\/{(" . self::PARAMETER_NAME_REGEX . ")\?}\$";
				while (preg_match('`' . $endingOptionalParameterRegex . '`', $uri, $matches)) {
					$uri = preg_replace('`' . $endingOptionalParameterRegex . '`', '', $uri);
				}
				return str_replace('//', '/', URL . $uri);
			}
		}
		throw new RouteNotFoundByNameException('Unable to find "' . $name . '" route');
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

		throw new RouteNotFoundException("Page not found", 404);
	}

}

class MissingRouteParameterException extends \Exception {
	
}

class RouteNotFoundByNameException extends \Exception {
	
}

class RouteNotFoundException extends \Exception {
	
}
