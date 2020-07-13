<?php

namespace Http\Itso\Front\Modules\Connexion;

use Epic\Http\Request;

class ConnexionController extends \Epic\BaseController {

	public function loginAction() {

		if ($this->application->user()->isAuthenticated()) {
			redirect($app->router()->getRoute('front_profile'));
		}

		if ($this->application->request()->requestMethod() == Request::POST) {

			$pdo = \PdoProvider::getInstance();

			$email = $this->application->request()->post('email');
			$password = $this->application->request()->post('password');

			$stmt = $pdo->prepare("SELECT * FROM user WHERE user_type_id = 4 AND email LIKE ?");
			$stmt->execute([$email]);

			if (false !== ($user = $stmt->fetch())) {

				if (password_verify($password, $user['password'])) {
					$this->application->user()->setAuthenticated();

					$_SESSION['id'] = $user['id'];
					$_SESSION['first_name'] = $user['first_name'];
					$_SESSION['last_name'] = $user['last_name'];

					redirect($this->router()->getRoute('front_home'));
				} else {
					$this->application->user()->setFlash("Mot de passe erroné");
				}
			} else {
				$this->application->user()->setFlash("E-mail inconnu");
			}
		}

		$app = $this->application;
		$user = $this->application->user();
		$url = URL;
		require ROOT . '/public/views/front/login.php';
	}

	public function registerAction() {

		if ($this->application->user()->isAuthenticated()) {
			redirect($app->router()->getRoute('front_profile'));
		}

		if ($this->application->request()->requestMethod() == Request::POST) {

			$pdo = \PdoProvider::getInstance();

			$lastName = $this->application->request()->post('last_name');
			$firstName = $this->application->request()->post('first_name');
			$email = $this->application->request()->post('email');
			$password = $this->application->request()->post('password');
			$passwordConfirm = $this->application->request()->post('password_confirm');
			$dayOfBirthDay = $this->application->request()->post('day_of_birth_day');
			$dayOfBirthMonth = $this->application->request()->post('day_of_birth_month');
			$dayOfBirthYear = $this->application->request()->post('day_of_birth_year');
			$gender = $this->application->request()->post('gender');

			$dayOfBirth = $dayOfBirthYear . '-' . $dayOfBirthMonth . '-' . $dayOfBirthDay;
			$pictureId = null;
			$language = 1;
			$nationality = 1;
			$createdAt = date('Y-m-d H:i:s');
			$updatedAt = date('Y-m-d H:i:s');
			$state = 1;
			$active = 1;
			$userTypeId = 4;
			$charityId = null;

			$stmt = $pdo->prepare("SELECT * FROM user WHERE user_type_id = 4 AND email LIKE ?");
			$stmt->execute([$email]);
			if ($stmt->fetch()) {
				$this->application->user()->setFlash("Cette adresse mail est déjà enregistrée");
				redirect($this->application->router()->getRoute('front_register'));
			}


			$stmt = $pdo->prepare("INSERT INTO `user` (`last_name`, `first_name`, `day_of_birth`, `email`, `password`, `gender`, `picture_id`, `language`, `nationality`, `state`, `active`, `user_type_id`, `charity_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->execute([
				$lastName,
				$firstName,
				$dayOfBirth,
				$email,
				$password,
				$gender,
				$pictureId,
				$language,
				$nationality,
				$state,
				$active,
				$userTypeId,
				$charityId
			]);

			$id = $pdo->lastInsertId();
			$this->application->user()->setAuthenticated();
			$this->application->user()->setAttribute('id', $id);
			redirect($this->application->router()->getRoute('front_home'));
		}

		$app = $this->application;
		$user = $this->application->user();
		$url = URL;
		require ROOT . '/public/views/front/register.php';
	}

	public function profileAction() {
		if (!$this->application->user()->isAuthenticated()) {
			redirect($this->router()->getRoute('front_login'));
		}

		$app = $this->application;
		$user = $this->application->user();
		$url = URL;
		require ROOT . '/public/views/front/profile.php';
	}

	public function logoutAction() {
		$this->application->user()->setAuthenticated(false);
		redirect($this->router()->getRoute('front_home'));
		session_destroy();
	}

}
