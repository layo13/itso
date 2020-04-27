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
