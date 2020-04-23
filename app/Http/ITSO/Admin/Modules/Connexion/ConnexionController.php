<?php

namespace Http\Itso\Admin\Modules\Connexion;

use Epic\Http\Request;

class ConnexionController extends \Epic\BaseController {

	public function loginAction() {



		if ($this->application->request()->requestMethod() == Request::POST) {

			$pdo = \PdoProvider::getInstance();

			$email = $this->application->request()->post('email');
			$password = $this->application->request()->post('password');

			$stmt = $pdo->prepare("SELECT * FROM user WHERE user_type_id = 1 AND email LIKE ?");
			$stmt->execute([$email]);

			if (false !== ($user = $stmt->fetch())) {

				if (password_verify($password, $user['password'])) {
					$this->application->user()->setAuthenticated();

					$_SESSION['id'] = $user['id'];
					$_SESSION['first_name'] = $user['first_name'];
					$_SESSION['last_name'] = $user['last_name'];

					redirect('http://localhost/itso/admin/');
				} else {
					$this->application->user()->setFlash("Mot de passe erroné");
				}
			} else {
				$this->application->user()->setFlash("E-mail inconnu");
			}
		}

		$url = 'http://localhost/itso/';
		$user = $this->application->user();

		require ROOT . '/public/views/admin/login.php';
	}

	public function logoutAction() {
		$this->application->user()->setAuthenticated(false);
		session_destroy();
		redirect('http://localhost/itso/admin');
	}

}
