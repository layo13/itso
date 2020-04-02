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