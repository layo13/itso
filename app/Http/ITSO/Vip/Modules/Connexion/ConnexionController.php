<?php

namespace Http\Itso\Vip\Modules\Connexion;

use Epic\Http\Request;

class ConnexionController extends \Epic\BaseController {

	public function loginAction() {



		if ($this->application->request()->requestMethod() == Request::POST) {

			$pdo = \PdoProvider::getInstance();

			$email = $this->application->request()->post('email');
			$password = $this->application->request()->post('password');

			$stmt = $pdo->prepare("SELECT user.*, picture.name picture_name FROM user LEFT JOIN picture ON (picture.id = user.picture_id) WHERE user_type_id = 2 AND email LIKE ?");
			$stmt->execute([$email]);

			if (false !== ($user = $stmt->fetch())) {

				if (password_verify($password, $user['password'])) {
					$this->application->user()->setAuthenticated();

					$_SESSION['id'] = $user['id'];
					$_SESSION['first_name'] = $user['first_name'];
					$_SESSION['last_name'] = $user['last_name'];
					$_SESSION['picture_name'] = $user['picture_name'];

					redirect('http://localhost/itso/vip/');
				} else {
					$this->application->user()->setFlash("Mot de passe erroné");
				}
			} else {
				$this->application->user()->setFlash("E-mail inconnu");
			}
		}

		$url = 'http://localhost/itso/';
		$user = $this->application->user();

		require ROOT . '/public/views/vip/login.php';
	}

	public function logoutAction() {
		$this->application->user()->setAuthenticated(false);
		redirect('http://localhost/itso/vip');
		session_destroy();
	}

}
