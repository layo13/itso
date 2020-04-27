<?php

namespace Http\Itso\Vip\Modules\Product;

use Epic\Upload\File;
use Epic\Upload\FileUploader;
use Epic\BaseController;

class ProductController extends BaseController {

	public function createAction() {
        $url = URL;
        $app = $this->application;
        $userSession = $this->application->user();
        $q = $this->pdo()->query("SELECT * FROM user where id = " . intval($userSession['id']));
        $user = $q->fetch(\PDO::FETCH_ASSOC);

        $q = $this->pdo()->query("SELECT * FROM product_category order by parent_id");
        //-- faire la gestion de tableau multi-dimensionnelle
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $product_category[] = $datas;
        }

        $q = $this->pdo()->query("SELECT *,(select picture.name from picture where picture.id = brand.picture_id) as brand_picture FROM brand");
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $brands[] = $datas;
        }
        require ROOT . '/public/views/admin/product/create.php';
	}

	public function addAction() {
        $url = URL;
        $app = $this->application;
        $userSession = $this->application->user();
        $q = $this->pdo()->query("SELECT * FROM user where id = " . intval($userSession['id']));
        $user = $q->fetch(\PDO::FETCH_ASSOC);

        $name = $_REQUEST['formProductName'];
        $brand_id = $_REQUEST['formProductBrandId'];
        $main_color = $_REQUEST['formProductMainColor'];
        $product_type_id = $_REQUEST['formProductProductTypeId'];
        $state = 1;
        //-- creation du produit
        $sqlCreateProduct = "INSERT INTO `product`(name, brand_id, main_color, product_type_id, state) VALUES (?,?,?,?,?)";
        $stmt = $this->pdo()->prepare($sqlCreateProduct);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $brand_id);
        $stmt->bindParam(3, $main_color);
        $stmt->bindParam(4, $product_type_id);
        $stmt->bindParam(5, $state);
        $stmt->execute();

        $resultProduct = $this->pdo()->lastInsertId();
        $product_id = intval($resultProduct);

        //-- creation du/des liens du produit
        $url = $_REQUEST['formProductLink'];
        $state = 1;
        $sqlCreateProductLink = "INSERT INTO `product_link`(url, product_id, state) VALUES (?,?,?)";
        $stmt = $this->pdo()->prepare($sqlCreateProductLink);
        $stmt->bindParam(1, $url);
        $stmt->bindParam(2, $product_id);
        $stmt->bindParam(3, $state);
        $stmt->execute();

        //-- creation de(s) image(s)
        $uploader = new FileUploader();
        $file = new File('formProductFile');
        //-- voir pour formater les noms d'images fonction php faire des id uniqid()
        $filename = $file->getName();
        $uploader->upload($file, ROOT . "/public/assets/images/product/" . $filename . "." . $file->getExtension());

        if (!empty($filename)) {
            $name = $_REQUEST['formProductName'];
            $stmt = $this->pdo()->prepare("INSERT INTO `pictures`(`name`) VALUES (?)");
            $stmt->bindParam(1, $name);
            $stmt->execute();

            $resultPicture = $this->pdo()->lastInsertId();
            $picture_id = intval($resultPicture);

            //-- creation de(s) association(s) entre les tables
            $sqlCreateAssociation = "INSERT INTO `product_picture`(`product_id`, `picture_id`) VALUES (?,?)";
            $stmt = $this->pdo()->prepare($sqlCreateAssociation);
            $stmt->bindParam(1, $product_id);
            $stmt->bindParam(2, $picture_id);
            $stmt->execute();
        }

        $q = $this->pdo()->query("SELECT * FROM product_category order by parent_id");
        //-- faire la gestion de tableau multi-dimensionnelle
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $product_category[] = $datas;
        }

        $q = $this->pdo()->query("SELECT *,(select picture.name from picture where picture.id = brand.picture_id) as brand_picture FROM brand");
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $brands[] = $datas;
        }
        require ROOT . '/public/views/admin/product/create.php';
	}

	public function listAction() {
        $url = URL;
        $app = $this->application;
        $userSession = $this->application->user();
        $q = $this->pdo()->query("SELECT * FROM user where id = " . intval($userSession['id']));
        $user = $q->fetch(\PDO::FETCH_ASSOC);

		$q = $this->pdo()->query("SELECT product.*,
(select name from picture where picture.id = (select picture_id from brand where brand.id = product.brand_id)) as brand_picture, 
(select name from brand where brand.id = product.brand_id) as brandname, 
(select name from product_category where product_category.id = product.product_type_id) as productCategory 
 FROM product,user_product where user_product.product_id = product.id and user_product.user_id = " .intval($user['id']));
		while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
			$products[] = $datas;
		}
		
		$url = URL;
		$app = $this->application;
		
		require ROOT . '/public/views/admin/product/index.php';
	}

	public function viewAction() {
        $url = URL;
        $app = $this->application;
        $userSession = $this->application->user();
        $q = $this->pdo()->query("SELECT * FROM user where id = " . intval($userSession['id']));
        $user = $q->fetch(\PDO::FETCH_ASSOC);

		$q = $this->pdo()->query("SELECT product.*, 
(select name from picture where picture.id = (select picture_id from brand where brand.id = product.brand_id)) as brand_picture, 
(select name from brand where brand.id = product.brand_id) as brandname, 
(select name from product_category where product_category.id = product.product_type_id) as productCategory 
FROM product,user_product where id = " . intval($GLOBALS['matches'][0])) ." and user_product.product_id = product.id and user_product.user_id = " .intval($user['id']);
		$product = $q->fetch(\PDO::FETCH_ASSOC);

        $q = $this->pdo()->query("SELECT *, (select count(*) as nbLink from product_link_click where product_link_id = product_link.id) as nbProductLink FROM product_link where product_id = ".$product['id']);
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $productLink[] = $datas;
        }
        require ROOT . '/public/views/admin/product/view.php';
	}


    public function updateAction() {

        $userSession = $this->application->user();
        $q = $this->pdo()->query("SELECT *,(select pictures.name from pictures where pictures.id = users.picture_id) as user_picture FROM user where id = " . intval($userSession['id']));
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

        $q = $this->pdo()->query("SELECT * FROM product_category order by parent_id");
        //-- faire la gestion de tableau multi-dimensionnelle
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $product_category[] = $datas;
        }

        $q = $this->pdo()->query("SELECT *,(select picture.name from picture where picture.id = brand.picture_id) as brand_picture FROM brand");
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $brands[] = $datas;
        }
        require ROOT . '/public/views/vip/product/view.php';
    }
    public function editAction() {

        $userSession = $this->application->user();
        $uploader = new FileUploader();
        $file = new File('formContactFile');
        //-- voir pour formater les noms d'images fonction php faire des id uniqid()
        $filename = $file->getName();
        $uploader->upload($file, ROOT . "/public/assets/images/users/" . $filename . "." . $file->getExtension());
        $q = $this->pdo()->query("SELECT * FROM user where id = " . intval($userSession['id']));
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

        $q = $this->pdo()->query("SELECT * FROM product_category order by parent_id");
        //-- faire la gestion de tableau multi-dimensionnelle
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $product_category[] = $datas;
        }

        $q = $this->pdo()->query("SELECT *,(select picture.name from picture where picture.id = brand.picture_id) as brand_picture FROM brand");
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $brands[] = $datas;
        }
        require ROOT . '/public/views/vip/product/update.php';
    }

    public function likeAction(){
        if (!empty($_REQUEST['formContactUserId']) && !empty($_REQUEST['formContactProductId'])) {
            $stmt = $this->pdo()->prepare("INSERT INTO `liked`(user_id,product_id,) VALUES (?)");
            $stmt->bindParam(1, $user_id);
            $stmt->bindParam(2, $product_id);
            $stmt->execute();
        }
    }
}
