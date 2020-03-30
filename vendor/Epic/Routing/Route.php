<?php

namespace Epic\Routing;

class Route {

	private $name;
	private $method;
	private $action;

	/**
	 *
	 * @var array Patterns
	 */
	private $uri;
	private $patterns;

	public function __construct($name, $method, $action, $uri, array $patterns) {
		$this->name = $name;
		$this->method = $method;
		$this->action = $action;
		$this->uri = $uri;
		$this->patterns = $patterns;
	}

	public function getAction(){
		return $this->action;
	}
	
	public function match($method, $requestURI, &$matches) {
		if ($method != $this->method) {
			return FALSE;
		}

		foreach ($this->patterns as $pattern) {
			if(preg_match('`^' . $pattern . '$`', $requestURI, $matches)){
				array_shift($matches);
				return TRUE;
			}
			
		}
		return FALSE;
	}

}
