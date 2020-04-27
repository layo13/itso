<?php

namespace Http\Itso\Vip\Modules\User;

use Epic\Upload\File;
use Epic\Upload\FileUploader;
use Epic\BaseController;

class UserController extends BaseController {

	public function listAction() {
		

		$q = $this->pdo()->query("SELECT *,(select picture.name from picture where picture.id = user.picture_id) as user_picture FROM user");
		while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
			$users[] = $datas;
		}
		
		$url = URL;
		$app = $this->application;
		
		require ROOT . '/public/views/vip/user/index.php';
	}

	public function viewAction() {
		$q = $this->pdo()->query("SELECT *,(select pictures.name from pictures where pictures.id = users.picture_id) as user_picture FROM user where id = " . intval($GLOBALS['matches'][0]));
		$user = $q->fetch(\PDO::FETCH_ASSOC);
		return view('users/view', compact('user'));
	}


	public function updateAction() {

        $app = $this->application->user();
        $q = $this->pdo()->query("SELECT *,(select pictures.name from pictures where pictures.id = users.picture_id) as user_picture FROM user where id = " . $app->user()->getAttribute('id'));
        $user = $q->fetch(\PDO::FETCH_ASSOC);

        $last_name = $user['last_name'];
        $first_name = $user['first_name'];
        $email = $user['email'];
        $password = $user['password'];
        $day_of_birth = $user['day_of_birth'];
        $gender = $user['gender'];
        $language = $user['language'];
        $nationality = $user['nationality'];

        if(!empty($_REQUEST['formContactLastName'])){      $last_name = $_REQUEST['formContactLastName'];}
        if(!empty($_REQUEST['formContactFirstName'])){     $first_name = $_REQUEST['formContactFirstName'];}
        if(!empty($_REQUEST['formContactDateOfBirth'])){   $day_of_birth = $_REQUEST['formContactDateOfBirth'];}
        if(!empty($_REQUEST['formContactEmail'])){         $email = $_REQUEST['formContactEmail'];}
        if(!empty($_REQUEST['formContactPassword'])){      $password = $_REQUEST['formContactPassword'];}
        if(!empty($_REQUEST['gender'])){                   $gender = $_REQUEST['gender'];}
        if(!empty($_REQUEST['formContactLanguage'])){      $language = $_REQUEST['formContactLanguage'];}
        if(!empty($_REQUEST['formContactNationality'])){   $nationality = $_REQUEST['formContactNationality'];}

        $url = URL;
        $app = $this->application;

        require ROOT . '/public/views/vip/user/view.php';
		//return view('users/view', compact(['user','last_name','firstname','day_of_birth','email','password','gender','language','nationality']));
	}

    public function editAction() {

        $app = $this->application->user();
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
            $stmt = $this->pdo()->prepare("INSERT INTO `pictures`(`name`) VALUES (?)");
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
        $id = $userSession['id'];


        $sqlUpdateUser ="UPDATE `user` SET last_name = ?, first_name = ?, day_of_birth = ?, email = ?, password = ?, gender = ?, picture_id = ?, language = ?, nationality = ?, created_at = ?, updated_at = ?, state = ?, active = ?, user_type_id = ?, charity_id = ? WHERE id=?";
        $stmt = $this->pdo()->prepare($sqlUpdateUser)->execute([$last_name,$first_name,$day_of_birth,$email,$password,$gender,$picture_id,$language,$nationality,$created_at,$updated_at,$state,$active,$user_type_id,$charity_id ,$id]);

        $url = URL;
        $app = $this->application;

        require ROOT . '/public/views/vip/user/update.php';
    }
}
