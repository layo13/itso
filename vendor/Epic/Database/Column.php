<?php

namespace Epic\Database;

class Column {

	const TYPE_INTEGER = 'integer';
	const TYPE_FLOAT = 'float';
	const TYPE_VARCHAR = 'varchar';
	const TYPE_DATETIME = 'datetime';
	const TYPE_TINYINTEGER = 'tiny';
	const TYPE_TEXT = 'text';
	const VARCHAR_DEFAULT_LENGTH = 255;

	private $name;
	private $type;
	private $length;
	private $nullable;
	private $default;
	private $primary;
	private $characterSetName; // jeu de caracteres
	private $collationName;
	private $comment;

	public function getName() {
		return $this->name;
	}

	public function getType() {
		return $this->type;
	}

	public function getLength() {
		return $this->length;
	}

	public function getNullable() {
		return $this->nullable;
	}

	public function getDefault() {
		return $this->default;
	}

	public function getPrimary() {
		return $this->primary;
	}

	public function getCharacterSetName() {
		return $this->characterSetName;
	}

	public function getCollationName() {
		return $this->collationName;
	}

	public function getComment() {
		return $this->comment;
	}

	public function integer($columName) {
		$this->type = self::TYPE_INTEGER;
		$this->name = $columName;
		return $this;
	}

	public function float($columName) {
		$this->type = self::TYPE_FLOAT;
		$this->name = $columName;
		return $this;
	}

	public function varchar($columName) {
		$this->type = self::TYPE_VARCHAR;
		$this->length = self::VARCHAR_DEFAULT_LENGTH;
		$this->name = $columName;
		return $this;
	}

	public function dateTime($columName) {
		$this->type = self::TYPE_DATETIME;
		$this->name = $columName;
		return $this;
	}

	public function tinyInteger($columName) {
		$this->type = self::TYPE_TINYINTEGER;
		$this->name = $columName;
		return $this;
	}

	public function text($columName) {
		$this->type = self::TYPE_TEXT;
		$this->name = $columName;
		return $this;
	}

	public function length($length) {
		$this->length = (int) $length;
		return $this;
	}

	public function nullable($nullable) {
		$this->nullable = $nullable;
		return $this;
	}

	public function primary($primary) {
		$this->primary = $primary;
		return $this;
	}

	public function defaultValue($default) {
		$this->default = $default;
		return $this;
	}

	public function comment($comment) {
		$this->comment = $comment;
		return $this;
	}

}

