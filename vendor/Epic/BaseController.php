<?php

namespace Epic;

abstract class BaseController {

	protected $pdo;

	public function __construct($pdo) {
		$this->pdo = $pdo;
	}

}
