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

	
}
