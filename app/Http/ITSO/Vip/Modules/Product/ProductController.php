<?php

namespace Http\Itso\Vip\Modules\Product;

use Epic\Upload\File;
use Epic\Upload\FileUploader;
use Epic\BaseController;

class ProductController extends BaseController {

	public function createAction() {
        $url = URL;
        $app = $this->application;

        $q = $this->pdo()->query("SELECT * FROM user where id = " . intval($app->user()->getAttribute('id')));
        $user = $q->fetch(\PDO::FETCH_ASSOC);

        $qParent = $this->pdo()->query("SELECT id,name,parent_id FROM product_category where parent_id is null");
        //-- faire la gestion de tableau multi-dimensionnelle
        while ($datas = $qParent->fetch(\PDO::FETCH_ASSOC)) {
            $product_category[$datas['id']]['value'] = $datas;
        }
        $qChildrens = $this->pdo()->query("select id,name,parent_id from product_category where parent_id in (SELECT id FROM product_category where parent_id is null)");
        while ($datas = $qChildrens->fetch(\PDO::FETCH_ASSOC)) {
            $product_category[$datas['parent_id']]['children'][$datas['id']]['value'] = $datas;
        }
        $q = $this->pdo()->query("SELECT brand.*, picture.name as brand_picture FROM brand LEFT JOIN picture ON (picture.id = brand.picture_id)");
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $brands[] = $datas;
        }
        $q = $this->pdo()->query("SELECT * FROM color");
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $colors[] = $datas;
        }
        require ROOT . '/public/views/vip/product/create.php';
	}

	public function addAction() {
        $url = URL;
        $app = $this->application;

        $q = $this->pdo()->query("SELECT * FROM user where id = " . intval($app->user()->getAttribute('id')));
        $user = $q->fetch(\PDO::FETCH_ASSOC);

        $name = $_REQUEST['formProductName'];
        $brand_id = $_REQUEST['formProductBrandId'];
        $main_color_id = $_REQUEST['formProductMainColorId'];
        $product_type_id = $_REQUEST['formCategoryProduct'];

        $state = 1;
        //-- creation du produit
        $sqlCreateProduct = "INSERT INTO `product`(name, brand_id, main_color_id, product_type_id, state) VALUES (?,?,?,?,?)";
        $stmt = $this->pdo()->prepare($sqlCreateProduct);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $brand_id);
        $stmt->bindParam(3, $main_color_id);
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
        $filename = rand(0,100)."_".$file->getName();
        $uploader->upload($file, ROOT . "/public/assets/images/product/" . $filename);

        if (!empty($filename)) {
            $name = $filename;
            $stmt = $this->pdo()->prepare("INSERT INTO `picture`(`name`) VALUES (?)");
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

        $sqlCreateAssociationUserProduct = "INSERT INTO `user_product`(`product_id`, `user_id`) VALUES (?,?)";
        $user_id = intval($app->user()->getAttribute('id'));
        $stmt = $this->pdo()->prepare($sqlCreateAssociationUserProduct);
        $stmt->bindParam(1, $product_id);
        $stmt->bindParam(2, $user_id);
        $stmt->execute();
        redirect($app->router()->getRoute('vip_product_list'));
	}

	public function listAction() {
        $url = URL;
        $app = $this->application;

         $q = $this->pdo()->query("SELECT product.*,
         picture.name as brand_picture,
         brand.name as brand_name,
         product_category.name as product_category,
         color.name as main_color
         FROM product
         LEFT JOIN color ON (product.main_color_id = color.id)
         LEFT JOIN user_product ON (product.id = user_product.product_id)
         LEFT JOIN product_category ON (product.product_type_id = product_category.id)
         LEFT JOIN brand ON (brand.id = product.brand_id)
         LEFT JOIN picture ON (picture.id = brand.picture_id)
         where user_product.user_id = " .intval($app->user()->getAttribute('id')));
        $products = [];
        $productsId = [];
		while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
			$products[] = $datas;
            $productsId[] = $datas['id'];
		}

        $q = $this->pdo()->query("SELECT picture.*,product_picture.product_id FROM picture  
LEFT JOIN product_picture ON (product_picture.picture_id = picture.id) where product_picture.product_id in(".implode(',',$productsId).") ");
        $productsPicture = [];
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $productsPicture[$datas['product_id']][] = $datas;
        }
        $q = $this->pdo()->query("SELECT * FROM product_link where product_id in(".implode(',',$productsId).") ");
        $productsLink = [];
        $productsLinkId = [];
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $productsLink[$datas['product_id']][] = $datas;
            $productsLinkId[] = $datas['id'];
        }
        $nbProductLinkClick = [];
        $q = $this->pdo()->query("SELECT count(*) as nb_product_link_click,product_link.product_id FROM product_link_click LEFT JOIN product_link ON (product_link_click.product_link_id = product_link.id) where product_link_id in (" .implode(',',$productsLinkId).") group by product_link_id");
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $nbProductLinkClick[$datas['product_id']] = $datas;
        }
        $nbProductLike = [];
        $q = $this->pdo()->query("SELECT count(*) as nb_product_like,product_id FROM liked where product_id in (" .implode(',',$productsId).") and user_id <> ".intval($app->user()->getAttribute('id'))." group by product_id");
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $nbProductLike[$datas['product_id']] = $datas;
        }
		require ROOT . '/public/views/vip/product/index.php';
	}

	public function viewAction() {
        $url = URL;
        $app = $this->application;

        $q = $this->pdo()->query("SELECT * FROM user where id = " . intval($app->user()->getAttribute('id')));
        $user = $q->fetch(\PDO::FETCH_ASSOC);

		$q = $this->pdo()->query("SELECT product.*,
         picture.name as brand_picture,
         brand.name as brandname,
         product_category.name as productCategory
         FROM product
         LEFT JOIN user_product ON (product.id = user_product.product_id)
         LEFT JOIN product_category ON (product.product_type_id = product_category.id)
         LEFT JOIN brand ON (brand.id = product.brand_id)
         LEFT JOIN picture ON (picture.id = brand.picture_id)
         where user_product.user_id =   " . intval($GLOBALS['matches'][0])) ." and user_product.user_id = " .intval($user['id']);
		$product = $q->fetch(\PDO::FETCH_ASSOC);

        $q = $this->pdo()->query("SELECT *, (select count(*) as nbLink from product_link_click where product_link_id = product_link.id) as nbProductLink FROM product_link where product_id = ".$product['id']);
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $productLink[] = $datas;
        }

        require ROOT . '/public/views/vip/product/view.php';
	}


    public function updateAction() {
        $url = URL;
        $app = $this->application;

        $q = $this->pdo()->query("SELECT *, picture.name as user_picture FROM user LEFT JOIN picture ON (picture.id = user.picture_id) where id = " . intval($app->user()->getAttribute('id')));
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


        $q = $this->pdo()->query("SELECT * FROM product_category order by parent_id");
        //-- faire la gestion de tableau multi-dimensionnelle
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $product_category[] = $datas;
        }

        $q = $this->pdo()->query("SELECT *, picture.name as brand_picture FROM brand LEFT JOIN picture ON (picture.id = brand.picture_id)");
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $brands[] = $datas;
        }
        require ROOT . '/public/views/vip/product/view.php';
    }
    public function editAction() {
        $url = URL;
        $app = $this->application;

        $uploader = new FileUploader();
        $file = new File('formContactFile');
        //-- voir pour formater les noms d'images fonction php faire des id uniqid()
        $filename = $file->getName();
        $uploader->upload($file, ROOT . "/public/assets/images/users/" . $filename . "." . $file->getExtension());
        $q = $this->pdo()->query("SELECT * FROM user where id = " . intval($app->user()->getAttribute('id')));
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
        $id = intval($app->user()->getAttribute('id'));


        $sqlUpdateUser ="UPDATE `user` SET last_name = ?, first_name = ?, day_of_birth = ?, email = ?, password = ?, gender = ?, picture_id = ?, language = ?, nationality = ?, created_at = ?, updated_at = ?, state = ?, active = ?, user_type_id = ?, charity_id = ? WHERE id=?";
        $stmt = $this->pdo()->prepare($sqlUpdateUser)->execute([$last_name,$first_name,$day_of_birth,$email,$password,$gender,$picture_id,$language,$nationality,$created_at,$updated_at,$state,$active,$user_type_id,$charity_id ,$id]);

        $q = $this->pdo()->query("SELECT * FROM product_category order by parent_id");
        //-- faire la gestion de tableau multi-dimensionnelle
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $product_category[] = $datas;
        }

        $q = $this->pdo()->query("SELECT *, picture.name as brand_picture FROM brand LEFT JOIN picture ON (picture.id = brand.picture_id)");
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $brands[] = $datas;
        }
        require ROOT . '/public/views/vip/product/update.php';
    }

    public function likeAction(){
        $url = URL;
        $app = $this->application;

        if (!empty($_REQUEST['formContactUserId']) && !empty($_REQUEST['formContactProductId'])) {
            $user_id = intval($_REQUEST['formContactUserId']);
            $product_id = intval($_REQUEST['formContactProductId']);
            $stmt = $this->pdo()->prepare("INSERT INTO `liked`(user_id,product_id,) VALUES (?)");
            $stmt->bindParam(1, $user_id);
            $stmt->bindParam(2, $product_id);
            $stmt->execute();
        }
    }
    public function publishAction(){
        $url = URL;
        $app = $this->application;
        if (!empty($_REQUEST['productId']) && (!empty($_REQUEST['active']) || $_REQUEST['active'] == '0')) {
            $product_id = intval($_REQUEST['productId']);
            $active = intval($_REQUEST['active']);
            if($active == 1){
                $active = 0;
            }else{
                $active = 1;
            }
            $sqlUpdateProduct = "UPDATE `product` SET active = ? where id = ?";
            $stmt = $this->pdo()->prepare($sqlUpdateProduct)->execute([$active,$product_id]);
            return 1;
        }
        return 0;
    }
}
