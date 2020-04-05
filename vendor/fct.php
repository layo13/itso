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

function est_multiple($nombre, $multiple){
    if($nombre % $multiple == 0)
        return true;
    else
        return false;
}

function getGender($genderId){
    if($genderId == 1)
        return "<i class=\"fa fa-mars\"></i>";
    else
        return "<i class=\"fa fa-venus\"></i>";

}
function getUserEtat($etatId){
    if($etatId == 1)
        return "Nouveau";
    else
        return "Archivé";

}
function getCountrieFlag($flagId){
    if($flagId == 1)
        return "../public/assets/images/flag/fr.png";
    else
        return "../public/assets/images/flag/en.png";

}