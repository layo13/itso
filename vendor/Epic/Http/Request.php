<?php

namespace Epic\Http;

class Request {

	/**
	 * La méthode GET demande une représentation de la ressource spécifiée. Les requêtes GET doivent uniquement être utilisées afin de récupérer des données.
	 */
	const GET = 'GET';

	/**
	 * La méthode HEAD demande une réponse identique à une requête GET pour laquelle on aura omis le corps de la réponse (on a uniquement l'en-tête).
	 */
	const HEAD = 'HEAD';

	/**
	 * La méthode POST est utilisée pour envoyer une entité vers la ressource indiquée. Cela  entraîne généralement un changement d'état ou des effets de bord sur le serveur.
	 */
	const POST = 'POST';

	/**
	 * La méthode PUT remplace toutes les représentations actuelles de la ressource visée par le contenu de la requête.
	 */
	const PUT = 'PUT';

	/**
	 * La méthode DELETE supprime la ressource indiquée.
	 */
	const DELETE = 'DELETE';

	public function requestUri() {
		return str_replace('/itso/', '/', $_SERVER['REQUEST_URI']);
	}

	public function requestMethod() {
		$requestMethod = $_SERVER['REQUEST_METHOD'];
		if ($requestMethod == self::POST && !empty($_POST['_method']) && in_array($_POST['_method'], self::httpVerbs())) {
			return $_POST['_method'];
		} else {
			return $requestMethod;
		}
	}

	public function get($key) {
		return empty($_GET[$key]) ? null : $_GET[$key];
	}

	public function post($key) {
		return empty($_POST[$key]) ? null : $_POST[$key];
	}

	public static function httpVerbs() {
		return [
			self::GET,
			self::HEAD,
			self::POST,
			self::PUT,
			self::DELETE
		];
	}

}
