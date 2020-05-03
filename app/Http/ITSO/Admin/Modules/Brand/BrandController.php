<?php

namespace Http\Itso\Admin\Modules\Brand;

use Epic\Upload\File;
use Epic\Upload\FileUploader;
use Epic\BaseController;

class BrandController extends BaseController {

    public function createAction() {
        $url = URL;
        $app = $this->application;
        require ROOT . '/public/views/vip/brand/create.php';
    }

    public function addAction() {
        $url = URL;
        $app = $this->application;

        $uploader = new FileUploader();
        $file = new File('formBrandFile');
        //-- voir pour formater les noms d'images fonction php faire des id uniqid()
        $filename = $file->getName();
        $uploader->upload($file, ROOT . "/public/assets/images/brand/" . $filename . "." . $file->getExtension());

        $sqlCreateBrand = "INSERT INTO `brand`(`name`,`active`) VALUES (?,?)";
        if (!empty($filename)) {
            $name = $_REQUEST['formBrandName'];
            $stmt = $this->pdo()->prepare("INSERT INTO `pictures`(`name`) VALUES (?)");
            $stmt->bindParam(1, $name);
            $stmt->execute();

            $result = $this->pdo()->lastInsertId();
            $picture_id = intval($result);
            $sqlCreateBrand = "INSERT INTO `brand`(`name`,`active`,`picture_id`) VALUES (?,?,?)";
        }
        //-- voir pour créer une classe Associations
        $name = $_REQUEST['formBrandName'];
        $active = $_REQUEST['formBrandActive'];

//-- penser à vérifier si l'email existe déjà
        $stmt = $this->pdo()->prepare($sqlCreateBrand);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $active);
        if (!empty($picture_id)) {
            $stmt->bindParam(3, $picture_id);
        }
        $stmt->execute();

        redirect($app->router()->getRoute('admin_brand_list'));
    }

    public function listAction() {
        $url = URL;
        $app = $this->application;

        $q = $this->pdo()->query("SELECT *, picture.name as brand_picture FROM brand LEFT JOIN picture ON (picture.id = brand.picture_id)");
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $brands[] = $datas;
        }

        require ROOT . '/public/views/vip/brand/index.php';
    }

    public function viewAction() {
        $url = URL;
        $app = $this->application;
        $q = $this->pdo()->query("SELECT *, picture.name as brand_picture FROM brand LEFT JOIN picture ON (picture.id = brand.picture_id) where id = " . intval($GLOBALS['matches'][0]));
        $brand = $q->fetch(\PDO::FETCH_ASSOC);
        require ROOT . '/public/views/vip/brand/view.php';
    }

}
