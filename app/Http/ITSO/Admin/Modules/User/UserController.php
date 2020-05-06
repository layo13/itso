<?php

namespace Http\Itso\Admin\Modules\User;

use Epic\Upload\File;
use Epic\Upload\FileUploader;
use Epic\BaseController;

class UserController extends BaseController {

	public function createAction() {
        $url = URL;
        $app = $this->application;
        require ROOT . '/public/views/admin/user/create.php';
	}

	public function addAction() {
        $url = URL;
        $app = $this->application;

		$uploader = new FileUploader();
		$file = new File('formContactFile');
		//-- voir pour formater les noms d'images fonction php faire des id uniqid()
		$filename = $file->getName();
		$sqlCreateUser = "INSERT INTO `user`(`last_name`, `firstname`, `day_of_birth`, `email`, `password`, `gender`, `language`, `nationality`, `state`) VALUES (?,?,?,?,?,?,?,?,?)";
		if (!empty($filename)) {
            $uploader->upload($file, ROOT . "/public/assets/images/users/" . $filename . "." . $file->getExtension());
			$name = $_REQUEST['formContactLastName'];
			$stmt = $this->pdo()->prepare("INSERT INTO `pictures`(`name`) VALUES (?)");
			$stmt->bindParam(1, $filename);
			$stmt->execute();

			$result = $this->pdo()->lastInsertId();
			$picture_id = intval($result);
			$sqlCreateUser = "INSERT INTO `user`(`last_name`, `firstname`, `day_of_birth`, `email`, `password`, `gender`, `language`, `nationality`, `state`, `picture_id`) VALUES (?,?,?,?,?,?,?,?,?,?)";
		}
		//-- voir pour créer une classe Users
		$name = $_REQUEST['formContactLastName'];
		$firstname = $_REQUEST['formContactFirstName'];
		$day_of_birth = $_REQUEST['formContactDateOfBirth'];
		$email = $_REQUEST['formContactEmail'];
		$password = $_REQUEST['formContactPassword'];
		$gender = $_REQUEST['gender'];
		$gender = 1;
		$language = $_REQUEST['formContactLanguage'];
		$nationality = $_REQUEST['formContactNationality'];
		$state = $_REQUEST['formContactStatus'];

//-- penser à vérifier si l'email existe déjà
		$stmt = $this->pdo()->prepare($sqlCreateUser);
		$stmt->bindParam(1, $name);
		$stmt->bindParam(2, $firstname);
		$stmt->bindParam(3, $day_of_birth);
		$stmt->bindParam(4, $email);
		$stmt->bindParam(5, $password);
		$stmt->bindParam(6, $gender);
		$stmt->bindParam(7, $language);
		$stmt->bindParam(8, $nationality);
		$stmt->bindParam(9, $state);
		if (!empty($picture_id)) {
			$stmt->bindParam(10, $picture_id);
		}
		$stmt->execute();

        $result = $this->pdo()->lastInsertId();
        $user_id = intval($result);
        redirect($app->router()->getRoute('admin_user_view',['id' => $user_id]));
	}
    public function updateAction() {
        $url = URL;
        $app = $this->application;
        $q = $this->pdo()->query("SELECT *, picture.name as user_picture FROM user LEFT JOIN picture ON user.picture_id = picture.id where user.id = " . intval($GLOBALS['matches'][0]));
        $user = $q->fetch(\PDO::FETCH_ASSOC);

        $last_name = $user['last_name'];
        $first_name = $user['first_name'];
        $email = $user['email'];
        $password = $user['password'];
        $day_of_birthFull = explode(" ",$user['day_of_birth']);
        $day_of_birth = $day_of_birthFull[0];
        $gender = $user['gender'];
        $language = $user['language'];
        $nationality = $user['nationality'];

        require ROOT . '/public/views/admin/user/update.php';
    }

    public function editAction() {
        $url = URL;
        $app = $this->application;

        $q = $this->pdo()->query("SELECT * FROM user where id = " . intval($GLOBALS['matches'][0]));
        $user = $q->fetch(\PDO::FETCH_ASSOC);
        $picture_id = $user['picture_id'];

        $uploader = new FileUploader();
        $file = new File('formContactFile');
        if(!empty($file)){
            //-- voir pour formater les noms d'images fonction php faire des id uniqid()
            $filename = $file->getName();
            if (!empty($filename)) {
                $uploader->upload($file, ROOT . "/public/assets/images/users/" . $filename . "." . $file->getExtension());
                $name = $_REQUEST['formContactLastName'];
                $stmt = $this->pdo()->prepare("INSERT INTO `picture`(`name`) VALUES (?)");
                $stmt->bindParam(1, $filename);
                $stmt->execute();

                $result = $this->pdo()->lastInsertId();
                $picture_id = intval($result);
            }
        }

        $last_name = $_REQUEST['formContactLastName'];
        $first_name = $_REQUEST['formContactFirstName'];
        $day_of_birth = $_REQUEST['formContactDateOfBirth'];
        $email = $_REQUEST['formContactEmail'];
        $password = $_REQUEST['formContactPassword'];
        $gender = 2;
        if(!empty($_REQUEST['gender'])){
            $gender = 1;
        }
        $language = $_REQUEST['formContactLanguage'];
        $nationality = $_REQUEST['formContactNationality'];

        $created_at = $user['created_at'];
        $updated_at = $user['updated_at']; //-- à changer
        $state = $user['state'];
        $active = $user['active'];
        $user_type_id = $user['user_type_id'];
        $charity_id  = $user['charity_id'];
        $id = intval($GLOBALS['matches'][0]);


        $sqlUpdateUser ="UPDATE `user` SET last_name = ?, first_name = ?, day_of_birth = ?, email = ?, password = ?, gender = ?, picture_id = ?, language = ?, nationality = ?, created_at = ?, updated_at = ?, state = ?, active = ?, user_type_id = ?, charity_id = ? WHERE id=?";
        $stmt = $this->pdo()->prepare($sqlUpdateUser)->execute([$last_name,$first_name,$day_of_birth,$email,$password,$gender,$picture_id,$language,$nationality,$created_at,$updated_at,$state,$active,$user_type_id,$charity_id ,$id]);

        redirect($app->router()->getRoute('admin_user_view',['id' => intval($GLOBALS['matches'][0])]));
    }
	public function listAction() {
        $url = URL;
        $app = $this->application;
		$q = $this->pdo()->query("SELECT user.*,
        picture.name as user_picture,
        charity_association.name as charity_name,
        celebrity_category.name as celebrity_category_name,
        user_type.name as user_type_name 
        FROM user 
        LEFT JOIN picture ON user.picture_id = picture.id
        LEFT JOIN user_type ON user.user_type_id = user_type.id
        LEFT JOIN user_celebrity_category ON user.id = user_celebrity_category.user_id
        LEFT JOIN celebrity_category ON user_celebrity_category.celebrity_category_id = celebrity_category.id
        LEFT JOIN charity_association ON user.charity_id = charity_association.id ");
		while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
			$users[] = $datas;
            $userId[] = $datas['id'];
		}

		require ROOT . '/public/views/admin/user/index.php';
	}

	public function viewAction() {
        $url = URL;
        $app = $this->application;
		$q = $this->pdo()->query("SELECT user.*,
        picture.name as user_picture,
        charity.name as charity_name 
        FROM user 
        LEFT JOIN picture ON user.picture_id = picture.id
        LEFT JOIN charity ON user.charity_id = charity.id 
        where id = " . intval($GLOBALS['matches'][0]));
		$user = $q->fetch(\PDO::FETCH_ASSOC);
        require ROOT . '/public/views/admin/user/view.php';
	}

}
