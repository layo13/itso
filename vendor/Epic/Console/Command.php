<?php

namespace Epic\Console;

class Command {

    /**
	 *
	 * @var \PDO 
	 */
	protected $pdo;

	function __construct(\PDO $pdo = null) {
		$this->pdo = $pdo;
	}

}
