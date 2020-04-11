<?php

namespace Http\Itso\Admin\Modules\Connexion;

use Epic\Http\Request;

class ConnexionController extends \Epic\BaseController {

	public function loginAction() {



		if ($this->application->request()->requestMethod() == Request::POST) {

			$pdo = \PdoItsof::getInstance();

			$email = $this->application->request()->post('email');
			$password = $this->application->request()->post('password');

			$stmt = $pdo->prepare("SELECT * FROM user WHERE user_type_id = 1 AND email LIKE ?");
			$stmt->execute([$email]);
			$user = $stmt->fetch();

			if (password_verify($password, $user['password'])) {
				$this->application->user()->setAuthenticated();
				redirect('http://localhost/itso/admin/');
			} else {
				$this->application->user()->setFlash("Mot de passe erroné");
			}
		}

		$url = 'http://localhost/itso/';
		$user = $this->application->user();

		require ROOT . '/public/views/admin/login.php';
	}

	public function logoutAction() {
		$this->application->user()->setAuthenticated(false);
		redirect('http://localhost/itso/admin');
	}

}
