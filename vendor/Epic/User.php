<?php

namespace Epic;

session_start();

class User {

	public function getAttribute($attr) {
		return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
	}

	public function getFlash() {
		$flash = $_SESSION['flash'];
		unset($_SESSION['flash']);

		return $flash;
	}

	public function hasFlash() {
		return isset($_SESSION['flash']);
	}

	public function isAuthenticated() {
		return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
	}

	public function setAttribute($attr, $value) {
		$_SESSION[$attr] = $value;
	}

	public function setAuthenticated($authenticated = true) {
		if (!is_bool($authenticated)) {
			throw new \InvalidArgumentException('Specified value $authenticated to ' . __METHOD__ . ' must be a boolean');
		}

		$_SESSION['auth'] = $authenticated;
	}

	public function setFlash($value) {
		$_SESSION['flash'] = $value;
	}

}