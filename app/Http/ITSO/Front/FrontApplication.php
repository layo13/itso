<?php

namespace Http\Itso\Front;

use Epic\BaseApplication;
use Epic\Http\Request;

class FrontApplication extends BaseApplication {

	public function run() {

		/*if ($this->user->isAuthenticated()) {*/
			list($controllerName, $action, $matches) = $this->getControllerAction();
		/*} else {
			$controllerName = Modules\Connexion\ConnexionController::class;
			$action = 'login';
			$matches = [];
		}*/
		
		$controller = new $controllerName($this);

		echo call_user_func_array([$controller, $action . 'Action'], $matches);
		exit;
	}

}
