<?php

namespace HTTP\ITSO\Admin;

class BlogController extends \Epic\BaseController {

	public function homeAction() {
	    require ROOT . '/public/views/users/create.php';
		return "Bienvenue sur l'admin partie blog !";
	}

}
