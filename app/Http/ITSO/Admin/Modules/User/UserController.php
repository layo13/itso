<?php

namespace Http\Itso\Admin\Modules\User;

use Epic\Upload\File;
use Epic\Upload\FileUploader;

class UserController extends \Epic\BaseController {

	public function createAction() {
		return view('users/create');
	}

	public function addAction() {

		$uploader = new FileUploader();
		$file = new File('formContactFile');
		//-- voir pour formater les noms d'images fonction php faire des id uniqid()
		$filename = $file->getName();
		$uploader->upload($file, ROOT . "/public/assets/images/users/" . $filename . "." . $file->getExtension());

		$sqlCreateUser = "INSERT INTO `user`(`last_name`, `firstname`, `day_of_birth`, `email`, `password`, `gender`, `language`, `nationality`, `state`) VALUES (?,?,?,?,?,?,?,?,?)";
		if (!empty($filename)) {
			$name = $_REQUEST['formContactLastName'];
			$stmt = $this->pdo->prepare("INSERT INTO `pictures`(`name`) VALUES (?)");
			$stmt->bindParam(1, $filename);
			$stmt->execute();

			$result = $this->pdo->lastInsertId();
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
		$stmt = $this->pdo->prepare($sqlCreateUser);
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

		return view('users/create');
	}

	public function listAction() {
		$q = $this->pdo->query("SELECT *,(select picture.name from picture where picture.id = user.picture_id) as user_picture FROM user");
		while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
			$users[] = $datas;
		}
		return view('users/list', compact('users'));
	}

	public function viewAction() {
		$q = $this->pdo->query("SELECT *,(select pictures.name from pictures where pictures.id = users.picture_id) as user_picture FROM user where id = " . intval($GLOBALS['matches'][0]));
		$user = $q->fetch(\PDO::FETCH_ASSOC);
		return view('users/view', compact('user'));
	}

}
