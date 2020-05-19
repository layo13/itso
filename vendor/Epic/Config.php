<?php

namespace Epic;

class Config {
	
	const HTTP_HOST = 'httpHost';
	const URL = 'url';
	const DB_NAME = 'db.name';
	const DB_HOST = 'db.host';
	const DB_USER = 'db.user';
	const DB_PASSWORD = 'db.password';
	const DB_PORT = 'db.port';

	private $name, $values;

	public function __construct($name) {
		$this->name = $name;
	}

	public function getValue($key) {
		return isset($this->values[$key]) ? $this->values[$key] : NULL;
	}

	public function setValues(array $values) {
		$this->values = $values;
	}

}
