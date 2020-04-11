<?php

class PdoItsof {

	private static $dbname = 'itso';
	private static $host = '127.0.0.1';
	private static $user = 'root';
	private static $password = '';
	
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
				self::$instance = new PDO('mysql:dbname=' . self::$dbname . ';host=' . self::$host, self::$user, self::$password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			} catch (PDOException $e) {
				echo 'Connexion échouée : ' . $e->getMessage();
			}
		}

		return self::$instance;
	}

}

?>