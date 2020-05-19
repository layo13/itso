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

        if(!empty($_REQUEST['formProductLink'])){
            //-- creation du/des liens du produit
            foreach ($_REQUEST['formProductLink'] as $link) {
                $q = $this->pdo()->query("SELECT * FROM product_link where url = '" . $link . "' and product_id = " . $product_id);
                $productLink = $q->fetch(\PDO::FETCH_ASSOC);
                if(empty($productLink)) {
                    $state = 1;
                    $url = $link;
                    $sqlCreateProductLink = "INSERT INTO `product_link`(url, product_id, state) VALUES (?,?,?)";
                    $stmt = $this->pdo()->prepare($sqlCreateProductLink);
                    $stmt->bindParam(1, $url);
                    $stmt->bindParam(2, $product_id);
                    $stmt->bindParam(3, $state);
                    $stmt->execute();
                }
            }
        }

        //-- creation de(s) image(s)
        $uploader = new FileUploader();
        $file = new File('formProductFile');
        //-- voir pour formater les noms d'images fonction php faire des id uniqid()
        $filename = rand(0,100)."_".$file->getName();

        if (!empty($filename)) {
            $uploader->upload($file, ROOT . "/public/assets/images/product/" . $filename);
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
        $nbProductLike = [];
        $productsPicture = [];
        $productsLink = [];
        $productsLinkId = [];
        $nbProductLinkClick = [];
            while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
                $products[] = $datas;
                $productsId[] = $datas['id'];
            }

        if(!empty($productsId)) {
            $q = $this->pdo()->query("SELECT picture.*,product_picture.product_id FROM picture  
LEFT JOIN product_picture ON (product_picture.picture_id = picture.id) where product_picture.product_id in(" . implode(',', $productsId) . ") ");
            while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
                $productsPicture[$datas['product_id']][] = $datas;
            }
            $q = $this->pdo()->query("SELECT * FROM product_link where product_id in(" . implode(',', $productsId) . ") and state <> 5");
            while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
                $productsLink[$datas['product_id']][] = $datas;
                $productsLinkId[] = $datas['id'];
            }
            $q = $this->pdo()->query("SELECT count(*) as nb_product_link_click,product_link.product_id FROM product_link_click LEFT JOIN product_link ON (product_link_click.product_link_id = product_link.id) where product_link_id in (" . implode(',', $productsLinkId) . ") group by product_link_id");
            while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
                $nbProductLinkClick[$datas['product_id']] = $datas;
            }
            $q = $this->pdo()->query("SELECT count(*) as nb_product_like,product_id FROM liked where product_id in (" . implode(',', $productsId) . ") and user_id <> " . intval($app->user()->getAttribute('id')) . " group by product_id");
            while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
                $nbProductLike[$datas['product_id']] = $datas;
            }
        }
		require ROOT . '/public/views/vip/product/index.php';
	}

	public function viewAction($id) {
        $url = URL;
        $app = $this->application;

        $q = $this->pdo()->query("SELECT * FROM user where id = " . intval($app->user()->getAttribute('id')));
        $user = $q->fetch(\PDO::FETCH_ASSOC);

		$q = $this->pdo()->query("SELECT product.*,
         user_product.user_id as user_id,
         picture.name as brand_picture,
         brand.name as brand_name,
         product_category.name as product_category,
         color.name as main_color
         FROM product
         LEFT JOIN user_product ON (product.id = user_product.product_id)
         LEFT JOIN color ON (product.main_color_id = color.id)
         LEFT JOIN product_category ON (product.product_type_id = product_category.id)
         LEFT JOIN brand ON (brand.id = product.brand_id)
         LEFT JOIN picture ON (picture.id = brand.picture_id)
         where product.id = " . intval($id) ." and user_product.user_id = " .intval($user['id']));
		$product = $q->fetch(\PDO::FETCH_ASSOC);

        $q = $this->pdo()->query("SELECT *, (select count(*) as nbLink from product_link_click where product_link_id = product_link.id) as nbProductLink FROM product_link where state <> 5 and product_id = ".$id);
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $productLink[] = $datas;
        }

        $q = $this->pdo()->query("SELECT picture.*,product_picture.product_id FROM picture  
LEFT JOIN product_picture ON (product_picture.picture_id = picture.id) where product_picture.product_id in(".$id.") ");
        $productsPicture = [];
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $productsPicture[$id][] = $datas;
        }
        require ROOT . '/public/views/vip/product/view.php';
	}


    public function updateAction($id) {
        $url = URL;
        $app = $this->application;

        $q = $this->pdo()->query("SELECT product.*,
         user_product.user_id as user_id,
         picture.name as brand_picture,
         brand.name as brand_name,
         brand.id as brand_id,
         product_category.name as product_category,
         color.name as main_color,
         color.id as main_color_id
         FROM product
         LEFT JOIN user_product ON (product.id = user_product.product_id)
         LEFT JOIN color ON (product.main_color_id = color.id)
         LEFT JOIN product_category ON (product.product_type_id = product_category.id)
         LEFT JOIN brand ON (brand.id = product.brand_id)
         LEFT JOIN picture ON (picture.id = brand.picture_id)
         where product.id =   " . intval($id));
        $product = $q->fetch(\PDO::FETCH_ASSOC);

        $q = $this->pdo()->query("SELECT * FROM user where id = " . intval($product['user_id']));
        $user = $q->fetch(\PDO::FETCH_ASSOC);

        $q = $this->pdo()->query("select * from product_category where id = (SELECT parent_id FROM `product_category` WHERE id = ".intval($product['product_type_id']).")");
        $categoryProductSelect = $q->fetch(\PDO::FETCH_ASSOC);

        $q = $this->pdo()->query("SELECT * FROM product_link where product_id in(".$id.") and state <> 5");
        $productsLink = [];
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $productsLink[] = $datas;
        }

        $q = $this->pdo()->query("SELECT picture.*,product_picture.product_id FROM picture  
LEFT JOIN product_picture ON (product_picture.picture_id = picture.id) where product_picture.product_id in(".$id.") ");
        $productsPicture = [];
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $productsPicture[] = $datas;
        }
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

        require ROOT . '/public/views/vip/product/update.php';
    }

    public function editAction($id) {
        $url = URL;
        $app = $this->application;

        $q = $this->pdo()->query("SELECT * FROM product where id = " . intval($id));
        $product = $q->fetch(\PDO::FETCH_ASSOC);
        /**
         * Partie produit
         */
        $name = $product['name'];
        $brand_id = $product['brand_id'];
        $main_color_id = $product['main_color_id'];
        $product_type_id = $product['product_type_id'];
        $state = $product['state'];
        $active = $product['active'];

        if(!empty($_REQUEST['formProductName'])){
            $name = $_REQUEST['formProductName'];
        }
        if(!empty($_REQUEST['formProductBrandId'])){
            $brand_id = $_REQUEST['formProductBrandId'];
        }
        if(!empty($_REQUEST['formProductMainColorId'])){
            $main_color_id = $_REQUEST['formProductMainColorId'];
        }
        if(!empty($_REQUEST['formCategoryProduct'])){
            $product_type_id = $_REQUEST['formCategoryProduct'];
        }
        if(!empty($_REQUEST['formProductState'])){
            $state = $_REQUEST['formProductState'];
        }
        if(!empty($_REQUEST['formProductActive'])){
            $active = $_REQUEST['formProductActive'];
        }

        $sqlUpdateUser ="UPDATE `product` SET name = ?, brand_id = ?, main_color_id = ?, product_type_id = ?, state = ?, active = ? WHERE id=?";
        $stmt = $this->pdo()->prepare($sqlUpdateUser)->execute([$name,$brand_id,$main_color_id,$product_type_id,$state,$active,$id]);

        /**
         * Partie liens
         */
        $product_id = intval($product['id']);
        $q = $this->pdo()->query("SELECT * FROM product_link where product_id = " . $product_id);
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $productLinkTab[$datas['id']] = $datas;
        }
        if(!empty($_REQUEST['formProductLink'])){
            foreach ($_REQUEST['formProductLink'] as $link) {
                $q = $this->pdo()->query("SELECT * FROM product_link where url = '" . $link . "' and product_id = " . $product_id);
                $productLink = $q->fetch(\PDO::FETCH_ASSOC);
                if(empty($productLink)) {
                    $state = 1;
                    $url = $link;
                    $sqlCreateProductLink = "INSERT INTO `product_link`(url, product_id, state) VALUES (?,?,?)";
                    $stmt = $this->pdo()->prepare($sqlCreateProductLink);
                    $stmt->bindParam(1, $url);
                    $stmt->bindParam(2, $product_id);
                    $stmt->bindParam(3, $state);
                    $stmt->execute();
                }else{
                    unset($productLinkTab[$productLink['id']]);
                }
            }
        }
        if(!empty($productLinkTab)) {
            $state = 5;
            foreach ($productLinkTab as $productLinkUpdate){
                $sqlUpdateProductLink = "UPDATE `product_link` SET state = ? WHERE id=?";
                $id = $productLinkUpdate['id'];
                $stmt = $this->pdo()->prepare($sqlUpdateProductLink)->execute([$state, $id]);
            }
        }

        /**
         * Partie photos
         */
        $uploader = new FileUploader();
        $file = new File('formProductFile');
        //-- voir pour formater les noms d'images fonction php faire des id uniqid()
        $filename = $file->getName();
        if (!empty($filename)) {
            $q = $this->pdo()->query("SELECT * FROM product_picture where product_id = " . $product_id);
            while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
                $picture_id = intval($datas['picture_id']);
                $rqtDelete = 'DELETE FROM `picture` WHERE id = ?';
                $stmt = $this->pdo()->prepare($rqtDelete)->execute([$picture_id]);
            }

            /**
             * Partie association photos
             */
            $rqtDelete = 'DELETE FROM `product_picture` WHERE product_id = ?';
            $stmt = $this->pdo()->prepare($rqtDelete)->execute([$product_id]);

            $filename = rand(0,100)."_".$file->getName();
            $uploader->upload($file, ROOT . "/public/assets/images/product/" . $filename);
            $stmt = $this->pdo()->prepare("INSERT INTO `picture`(`name`) VALUES (?)");
            $stmt->bindParam(1, $filename);
            $stmt->execute();

            $result = $this->pdo()->lastInsertId();
            $picture_id = intval($result);

            //-- creation de(s) association(s) entre les tables
            $sqlCreateAssociation = "INSERT INTO `product_picture`(`product_id`, `picture_id`) VALUES (?,?)";
            $stmt = $this->pdo()->prepare($sqlCreateAssociation);
            $stmt->bindParam(1, $product_id);
            $stmt->bindParam(2, $picture_id);
            $stmt->execute();
        }

        redirect($app->router()->getRoute('vip_product_list'));
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
