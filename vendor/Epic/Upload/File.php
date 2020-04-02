<?php

namespace Upload;

class File {

	private $name;
	private $type;
	private $tmpName;
	private $error;
	private $size;

	public function __construct($key) {
		$this->name = $_FILES[$key]['name'];
		$this->type = $_FILES[$key]['type'];
		$this->tmpName = $_FILES[$key]['tmp_name'];
		$this->error = $_FILES[$key]['error'];
		$this->size = $_FILES[$key]['size'];
	}

	public function getName() {
		return $this->name;
	}

	public function getType() {
		return $this->type;
	}

	public function getTmpName() {
		return $this->tmpName;
	}

	public function getError() {
		return $this->error;
	}

	public function getSize() {
		return $this->size;
	}

	public function getExtension() {
		return pathinfo($this->name, PATHINFO_EXTENSION);
	}

}
