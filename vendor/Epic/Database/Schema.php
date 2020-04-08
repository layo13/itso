<?php

namespace Epic\Database;

class Schema {

	private $name;
	private $tables;

	public function __construct($name) {
		$this->name = $name;
		$this->tables = [];
	}

	public function getTables() {
		return $this->tables;
	}

	public function addTable($name, $callback, $comment = '') {
		$table = new Table($name);
		$callback($table);
		$table->setComment($comment);
		$this->tables[] = $table;
	}

}
