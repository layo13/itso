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
		$sqlCreateUser = "INSERT INTO `user`(`last_name`, `first_name`, `day_of_birth`, `email`, `password`, `gender`, `language`, `nationality`, `state`, `user_type_id`) VALUES (?,?,?,?,?,?,?,?,?,?)";
		if (!empty($filename)) {
            $uploader->upload($file, ROOT . "/public/assets/images/user/" . $filename);
			$name = $_REQUEST['formContactLastName'];
			$stmt = $this->pdo()->prepare("INSERT INTO `picture`(`name`) VALUES (?)");
			$stmt->bindParam(1, $filename);
			$stmt->execute();

			$result = $this->pdo()->lastInsertId();
			$picture_id = intval($result);
			$sqlCreateUser = "INSERT INTO `user`(`last_name`, `first_name`, `day_of_birth`, `email`, `password`, `gender`, `language`, `nationality`, `state`, `user_type_id`, `picture_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
		}
		//-- voir pour créer une classe Users
		$name = $_REQUEST['formContactLastName'];
		$first_name = $_REQUEST['formContactFirstName'];
		$day_of_birth = (!empty($_REQUEST['formContactDateOfBirth'])) ? $_REQUEST['formContactDateOfBirth'] : null;
		$email = $_REQUEST['formContactEmail'];
		$password = password_hash ($_REQUEST['formContactPassword'], PASSWORD_DEFAULT);
        $gender = 2;
        if(!empty($_REQUEST['gender'])){
            $gender = 1;
        }
		$language = $_REQUEST['formContactLanguage'];
		$nationality = $_REQUEST['formContactNationality'];
        $state = 1;
		if(!empty($_REQUEST['formContactStatus'])) {
            $state = $_REQUEST['formContactStatus'];
        }
        $route = $app->routeName();
		$routeTab = explode('_',$route);
		if($routeTab[1]=='vip' || $routeTab[1]=='user') {
            $user_type_id = 2;
        }elseif($routeTab[1]=='customer') {
            $user_type_id = 4;
        }
//-- penser à vérifier si l'email existe déjà
		$stmt = $this->pdo()->prepare($sqlCreateUser);
		$stmt->bindParam(1, $name);
		$stmt->bindParam(2, $first_name);
		$stmt->bindParam(3, $day_of_birth);
		$stmt->bindParam(4, $email);
		$stmt->bindParam(5, $password);
		$stmt->bindParam(6, $gender);
		$stmt->bindParam(7, $language);
		$stmt->bindParam(8, $nationality);
		$stmt->bindParam(9, $state);
		$stmt->bindParam(10, $user_type_id);
		if (!empty($picture_id)) {
			$stmt->bindParam(11, $picture_id);
		}
		$stmt->execute();

        $result = $this->pdo()->lastInsertId();
        $user_id = intval($result);
        redirect($app->router()->getRoute('admin_user_view',['id' => $user_id]));
	}
    public function updateAction($id) {
        $url = URL;
        $app = $this->application;
        $q = $this->pdo()->query("SELECT user.*, picture.name as user_picture FROM user LEFT JOIN picture ON user.picture_id = picture.id where user.id = " . $id);
        $user = $q->fetch(\PDO::FETCH_ASSOC);
		
        $id = $user['id'];
        $last_name = $user['last_name'];
        $first_name = $user['first_name'];
        $email = $user['email'];
        $password = $user['password'];
        if(!empty($_REQUEST['formContactDateOfBirth'])) {
            $day_of_birthFull = explode(" ", $user['day_of_birth']);
            $day_of_birth = $day_of_birthFull[0];
        }else{
            $day_of_birth = null;
        }

        $gender = $user['gender'];
        $language = $user['language'];
        $nationality = $user['nationality'];

        require ROOT . '/public/views/admin/user/update.php';
    }

    public function editAction($id) {
        $url = URL;
        $app = $this->application;

        $q = $this->pdo()->query("SELECT * FROM user where id = " . $id);
        $user = $q->fetch(\PDO::FETCH_ASSOC);
        $picture_id = $user['picture_id'];

        $uploader = new FileUploader();
        $file = new File('formContactFile');
        if(!empty($file)){
            //-- voir pour formater les noms d'images fonction php faire des id uniqid()
            $filename = $file->getName();
            if (!empty($filename)) {
                $uploader->upload($file, ROOT . "/public/assets/images/user/" . $filename);
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
        $day_of_birth = (!empty($_REQUEST['formContactDateOfBirth'])) ? $_REQUEST['formContactDateOfBirth'] : null;

        $email = $_REQUEST['formContactEmail'];
        $password = $_REQUEST['formContactPassword'];
        if($password != $user['password']){
            $password = password_hash ($_REQUEST['formContactPassword'], PASSWORD_DEFAULT);
        }
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


        $sqlUpdateUser ="UPDATE `user` SET last_name = ?, first_name = ?, day_of_birth = ?, email = ?, password = ?, gender = ?, picture_id = ?, language = ?, nationality = ?, created_at = ?, updated_at = ?, state = ?, active = ?, user_type_id = ?, charity_id = ? WHERE id=?";
        $stmt = $this->pdo()->prepare($sqlUpdateUser)->execute([$last_name,$first_name,$day_of_birth,$email,$password,$gender,$picture_id,$language,$nationality,$created_at,$updated_at,$state,$active,$user_type_id,$charity_id ,$id]);

        redirect($app->router()->getRoute('admin_user_view',['id' => intval($id)]));
    }
	public function listAction() {
        $url = URL;
        $app = $this->application;
        $requeteSuite ='';
		$users=[];

        $route = $app->routeName();
        $routeTab = explode('_',$route);
        if($routeTab[1]=='vip' || $routeTab[1]=='user') {
            $requeteSuite = ' where user.user_type_id = 2';
        }elseif($routeTab[1]=='customer') {
            $requeteSuite = ' where user.user_type_id = 4';
        }

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
        LEFT JOIN charity_association ON user.charity_id = charity_association.id ".$requeteSuite);
		while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
			$users[] = $datas;
            $userId[] = $datas['id'];
		}

        $nbProduct = [];
        $nbSubscriber = [];
        $nbTotalLike = [];
        if(!empty($userId)) {
            $q = $this->pdo()->query("SELECT count(product_id) as nb_product, user_id FROM `user_product` where user_id in (" . implode(',', $userId) . ") group by user_id");
            while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
                $nbProduct[$datas['user_id']] = $datas;
            }
            $q = $this->pdo()->query("SELECT count(member_id) as nb_subscriber, celebrity_id FROM `subscription` where celebrity_id in (" . implode(',', $userId) . ") group by celebrity_id");
            while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
                $nbSubscriber[$datas['celebrity_id']] = $datas;
            }
            $q = $this->pdo()->query("SELECT count(liked.user_id) as nb_product_like,
        liked.product_id,
        user_product.user_id as celebrity_id 
        FROM `liked`
        LEFT JOIN user_product ON liked.product_id = user_product.product_id
        where user_product.user_id in (" . implode(',', $userId) . ")
        group by user_product.user_id");

            while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
                $nbTotalLike[$datas['celebrity_id']] = $datas;
            }
        }
		require ROOT . '/public/views/admin/user/index.php';
	}

	public function viewAction($id) {
        $url = URL;
        $app = $this->application;
		$q = $this->pdo()->query("SELECT user.*,
        picture.name as user_picture,
        charity_association.name as charity_name 
        FROM user 
        LEFT JOIN picture ON user.picture_id = picture.id
        LEFT JOIN charity_association ON user.charity_id = charity_association.id 
        where user.id = " . $id);
		$user = $q->fetch(\PDO::FETCH_ASSOC);
        require ROOT . '/public/views/admin/user/view.php';
	}

}
