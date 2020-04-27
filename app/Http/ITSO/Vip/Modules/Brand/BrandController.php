<?php

namespace Http\Itso\Vip\Modules\Brand;

use Epic\Upload\File;
use Epic\Upload\FileUploader;
use Epic\BaseController;

class BrandController extends BaseController {

	public function createAction() {
		return view('users/create');
	}

	public function addAction() {

		$uploader = new FileUploader();
		$file = new File('formContactFile');
		//-- voir pour formater les noms d'images fonction php faire des id uniqid()
		$filename = $file->getName();
        $uploader->upload($file, ROOT . "/public/assets/images/brand/" . $filename . "." . $file->getExtension());

        $sqlCreateAssociation = "INSERT INTO `brand`(`name`) VALUES (?)";
        if (!empty($filename)) {
            $name = $_REQUEST['formCharityName'];
            $stmt = $this->pdo()->prepare("INSERT INTO `pictures`(`name`) VALUES (?)");
            $stmt->bindParam(1, $name);
            $stmt->execute();

            $result = $this->pdo()->lastInsertId();
            $picture_id = intval($result);
            $sqlCreateAssociation = "INSERT INTO `brand`(`name`, `picture_id`) VALUES (?,?)";
        }
        //-- voir pour créer une classe Associations
        $name = $_REQUEST['formCharityName'];

//-- penser à vérifier si l'email existe déjà
        $stmt = $this->pdo()->prepare($sqlCreateAssociation);
        $stmt->bindParam(1, $name);
        if (!empty($picture_id)) {
            $stmt->bindParam(10, $picture_id);
        }
        $stmt->execute();


        return view('brand/create');
	}

	public function listAction() {

		$q = $this->pdo()->query("SELECT *,(select picture.name from picture where picture.id = brand.picture_id) as brand_picture FROM brand");
		while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
			$brands[] = $datas;
		}
		//return view('users/list', compact('users'));
		
		$url = URL;
		$app = $this->application;
		
		require ROOT . '/public/views/vip/brand/index.php';
	}

	public function viewAction() {
		$q = $this->pdo()->query("SELECT *,(select pictures.name from pictures where pictures.id = brand.picture_id) as brand_picture FROM brand where id = " . intval($GLOBALS['matches'][0]));
		$brand = $q->fetch(\PDO::FETCH_ASSOC);
		return view('brand/view', compact('brand'));
	}

}
