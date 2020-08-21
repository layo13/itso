<?php

class PdoProvider {

	public static $dbname = 'itso';
	public static $host = '127.0.0.1';
	public static $user = 'root';
	public static $password = 'root';
	public static $port = 3306;
	
	protected static $instance;

	protected function __construct() {
		
	}

	protected function __clone() {
		
	}

	/**
	 * 
	 * @return PDO
	 */
	public static function getInstance() {
		if (!isset(self::$instance)) {
			try {
				self::$instance = new PDO('mysql:dbname=' . self::$dbname . ';host=' . self::$host . ';port=' . self::$port, self::$user, self::$password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			} catch (PDOException $e) {
				die('Connexion échouée : ' . $e->getMessage());
			}
		}

		return self::$instance;
	}

}