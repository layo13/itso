<?php

/**
 * 
 * @param string $name
 * @param array $parameters
 */
function view($name, $parameters = []) {

	extract($parameters);

	$view = ROOT . '/public/views/' . $name . '.php';

	if (is_file($view)) {
		ob_start();
		require $view;
		return ob_get_clean();
	} else {
		throw new Exception("View $view does not exist");
	}
}

function redirect($location) {
	header('Location: ' . $location);
	exit;
}

////////////////////////////////////////////////////////////////////////////////
// STRING
////////////////////////////////////////////////////////////////////////////////

function startsWith($haystack, $needle) {
	// search backwards starting from haystack length characters from the end
	return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

function endsWith($haystack, $needle) {
	// search forward starting from end minus needle length characters
	return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

/**
 * Retourne la partie droite d'un chaine de caracteres d'une taille donnée.
 * @param string $str
 * @param int $len
 * @return string
 */
function right($str, $len) {
	return substr($str, strlen($str) - $len);
}

/**
 * Retourne la partie gauche d'un chaine de caracteres d'une taille donnée.
 * @param string $str
 * @param int $len
 * @return string
 */
function left($str, $len) {
	return substr($str, 0, $len);
}

////////////////////////////////////////////////////////////////////////////////
// ARRAYS
////////////////////////////////////////////////////////////////////////////////


function in($a, $_) {
	$args = func_get_args();
	array_shift($args);
	return in_array($a, $args);
}

function notIn($a, $_) {
	$args = func_get_args();
	array_shift($args);
	return !in_array($a, $args);
}

////////////////////////////////////////////////////////////////////////////////
// AUTRES
////////////////////////////////////////////////////////////////////////////////

function est_multiple($nombre, $multiple) {
	if ($nombre % $multiple == 0)
		return true;
	else
		return false;
}

function selectNavRubrique($last_position, $route, $position, $mid_position ='') {
    $tabRoute = explode('_',$route);
	if ($position == 0 && in_array($tabRoute[0],$last_position))
		return " kt-menu__item--here kt-menu__item--open";
	elseif (!empty($tabRoute[1]))
	    if ($position == 1 && in_array($tabRoute[1],$last_position))
        return " kt-menu__item--here kt-menu__item--open";
	elseif (!empty($tabRoute[2]))
	    if ($position == 2 && in_array($tabRoute[2],$last_position) && in_array($tabRoute[1],$mid_position))
		return " kt-menu__item--active";
}

function getGender($genderId) {
	if ($genderId == 2)
		return "<i class=\"fa fa-mars\"></i>";
	elseif ($genderId == 1)
		return "<i class=\"fa fa-venus\"></i>";
	else
		throw new InvalidArgumentException("unknown $genderId");
}

function getUserEtat($etatId) {
	if ($etatId == 1)
		return "Nouveau";
	else
		return "Archivé";
}

function getCountrieFlag($flagId) {
	if ($flagId == 1)
		return "public/assets/images/flag/fr.png";
	else
		return "public/assets/images/flag/en.png";
}

function curlRequest($url, $method = 'GET', $data = NULL, $header = array(), &$outHeader = '') {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	if ($method == "PUT" || $method == "POST") {
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
	} else if ($method == "DELETE") {
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
	}

	curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
	if (strpos($url, "https") === 0) {
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	}
	$response = curl_exec($ch);
	$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

	//var_dump($url, ($information = curl_getinfo($ch, CURLINFO_HEADER_OUT)) . $data, curl_getinfo($ch, CURLINFO_HTTP_CODE));

	$outHeader = substr($response, 0, $headerSize);
	$body = substr($response, $headerSize);
	curl_close($ch);
	return $body;
}