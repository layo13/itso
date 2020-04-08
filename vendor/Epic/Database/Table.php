<?php

namespace Epic\Database;

class Table {

	private $name;
	private $comment;
	private $columns;

	public function __construct($name, $comment = null) {
		$this->name = $name;
		$this->comment = $comment;
		$this->columns = [];
	}

	public function getName() {
		return $this->name;
	}
	
	public function getComment() {
		return $this->comment;
	}
	
	public function getColumns() {
		return $this->columns;
	}

	public function integer($columnName) {
		$column = new Column();
		$this->columns[] = $column;
		return $column->integer($columnName);
	}
	
	public function float($columnName) {
		$column = new Column();
		$this->columns[] = $column;
		return $column->float($columnName);
	}

	public function varchar($columnName) {
		$column = new Column();
		$this->columns[] = $column;
		return $column->varchar($columnName);
	}

	public function dateTime($columnName) {
		$column = new Column();
		$this->columns[] = $column;
		return $column->dateTime($columnName);
	}

	public function tinyInteger($columnName) {
		$column = new Column();
		$this->columns[] = $column;
		return $column->tinyInteger($columnName);
	}

	public function text($columnName) {
		$column = new Column();
		$this->columns[] = $column;
		return $column->text($columnName);
	}

	public function setComment($comment) {
		$this->comment = $comment;
	}

}
