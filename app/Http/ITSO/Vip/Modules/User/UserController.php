<?php

namespace Http\Itso\Vip\Modules\User;

use Epic\Upload\File;
use Epic\Upload\FileUploader;
use Epic\BaseController;

class UserController extends BaseController {

	public function listAction() {


        $url = URL;
        $app = $this->application;
		$q = $this->pdo()->query("SELECT *, picture.name as user_picture FROM user LEFT JOIN picture ON user.picture_id = picture.id");
		while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
			$users[] = $datas;
		}

		require ROOT . '/public/views/vip/user/index.php';
	}

	public function viewAction() {
        $url = URL;
        $app = $this->application;
		$q = $this->pdo()->query("SELECT *, picture.name as user_picture FROM user LEFT JOIN picture ON user.picture_id = picture.id where user.id = " . intval($GLOBALS['matches'][0]));
		$user = $q->fetch(\PDO::FETCH_ASSOC);
        require ROOT . '/public/views/vip/user/view.php';
	}

	public function profilAction() {
        $url = URL;
        $app = $this->application;
		$q = $this->pdo()->query("SELECT *, picture.name as user_picture FROM user LEFT JOIN picture ON user.picture_id = picture.id where user.id = " . $app->user()->getAttribute('id'));
		$user = $q->fetch(\PDO::FETCH_ASSOC);
        require ROOT . '/public/views/vip/user/view.php';
	}


	public function updateAction() {

        $url = URL;
        $app = $this->application;
        $q = $this->pdo()->query("SELECT *, picture.name as user_picture FROM user LEFT JOIN picture ON user.picture_id = picture.id where user.id = " . $app->user()->getAttribute('id'));
        $user = $q->fetch(\PDO::FETCH_ASSOC);

        $last_name = utf8_encode($user['last_name']);
        $first_name = utf8_encode($user['first_name']);
        $email = $user['email'];
        $password = $user['password'];
        $day_of_birth = $user['day_of_birth'];
        $gender = $user['gender'];
        $language = $user['language'];
        $nationality = $user['nationality'];

        require ROOT . '/public/views/vip/user/update.php';
	}

    public function editAction() {

        $url = URL;
        $app = $this->application;
        $uploader = new FileUploader();
        $file = new File('formContactFile');
        //-- voir pour formater les noms d'images fonction php faire des id uniqid()
        $filename = $file->getName();
        $uploader->upload($file, ROOT . "/public/assets/images/users/" . $filename . "." . $file->getExtension());
        $q = $this->pdo()->query("SELECT * FROM user where id = " . $app->user()->getAttribute('id'));
        $user = $q->fetch(\PDO::FETCH_ASSOC);
        $picture_id = $user['picture_id'];
        if (!empty($filename)) {
            $name = $_REQUEST['formContactLastName'];
            $stmt = $this->pdo()->prepare("INSERT INTO `picture`(`name`) VALUES (?)");
            $stmt->bindParam(1, $filename);
            $stmt->execute();

            $result = $this->pdo()->lastInsertId();
            $picture_id = intval($result);
        }

        $last_name = $_REQUEST['formContactLastName'];
        $first_name = $_REQUEST['formContactFirstName'];
        $day_of_birth = $_REQUEST['formContactDateOfBirth'];
        $email = $_REQUEST['formContactEmail'];
        $password = $_REQUEST['formContactPassword'];
        $gender = $_REQUEST['gender'];
        $language = $_REQUEST['formContactLanguage'];
        $nationality = $_REQUEST['formContactNationality'];


        $created_at = $user['created_at'];
        $updated_at = $user['updated_at']; //-- à changer
        $state = $user['state'];
        $active = $user['active'];
        $user_type_id = $user['user_type_id'];
        $charity_id  = $user['charity_id'];
        $id = $app->user()->getAttribute('id');


        $sqlUpdateUser ="UPDATE `user` SET last_name = ?, first_name = ?, day_of_birth = ?, email = ?, password = ?, gender = ?, picture_id = ?, language = ?, nationality = ?, created_at = ?, updated_at = ?, state = ?, active = ?, user_type_id = ?, charity_id = ? WHERE id=?";
        $stmt = $this->pdo()->prepare($sqlUpdateUser)->execute([$last_name,$first_name,$day_of_birth,$email,$password,$gender,$picture_id,$language,$nationality,$created_at,$updated_at,$state,$active,$user_type_id,$charity_id ,$id]);

        require ROOT . '/public/views/vip/user/update.php';
    }
}
