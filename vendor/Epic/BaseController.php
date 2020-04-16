<?php

namespace Epic;

abstract class BaseController {

	/**
	 *
	 * @var BaseApplication 
	 */
	protected $application;

	/**
	 * 
	 * @param BaseApplication $application
	 */
	public function __construct($application) {
		$this->application = $application;
	}

	/**
	 * 
	 * @return User
	 */
	public function user() {
		return $this->application->user();
	}

	/**
	 * 
	 * @return Request
	 */
	public function request() {
		return $this->application->request();
	}

	/**
	 * 
	 * @return Router
	 */
	public function router() {
		return $this->application->router();
	}
	
	/**
	 * 
	 * @return \PDO
	 */
	public function pdo() {
		return $this->application->pdo();
	}
}
