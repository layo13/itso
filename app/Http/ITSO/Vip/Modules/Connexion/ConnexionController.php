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

					redirect($this->router()->getRoute('vip_home'));
				} else {
					$this->application->user()->setFlash("Mot de passe erroné");
				}
			} else {
				$this->application->user()->setFlash("E-mail inconnu");
			}
		}

		$url = URL;
		$user = $this->application->user();

		require ROOT . '/public/views/vip/login.php';
	}

	public function logoutAction() {
		$this->application->user()->setAuthenticated(false);
		redirect($this->router()->getRoute('vip_home'));
		session_destroy();
	}

    public function passwordMailSendAction(){
/*
        if(!empty($_POST['formMdpOublieEmail'])){
            $secret = $GLOBALS['conf']['recaptcha_secret'];
            $response = null;
            $reCaptcha = new ReCaptcha($secret);

            if ($_POST["g-recaptcha-response"]) {
                $response = $reCaptcha->verifyResponse(
                    $_SERVER["REMOTE_ADDR"],
                    $_POST["g-recaptcha-response"]
                );
            }


            if ($response != null && $response->success) {
*/
                // Sujet
                $sujet = "Nouvelle inscription depuis le site ITSO";

                // Message
                $message = "test ";

                //-- Envoi du mail
                $from = "Itso <tbruno@intheshoesof.fr>";
                $headers  = 'MIME-Version: 1.0'."\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
                $headers .= 'Reply-To: '.$_POST['email']."\r\n";
                $headers .= 'X-Mailer: PHP/'.phpversion()."\r\n";

                $header = 'From: '.$from."\r\n".$headers;
                $to = $GLOBALS['conf']['to'];

                //verif si champ anti-robots est renseigné
                if($_POST['plus_client']==""){
                    if(@mail($to, $sujet, $message, $header)){
                        $result = 1;
                    }else{
                        $result = 0;
                    }
                }
                /*
            }else{
                $result = 0;
            }
        }
                */

        return $result;
    }

}
