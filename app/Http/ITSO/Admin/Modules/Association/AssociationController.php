<?php

namespace Http\Itso\Admin\Modules\Association;

use Epic\Upload\File;
use Epic\Upload\FileUploader;
use Epic\BaseController;

class AssociationController extends BaseController {

	public function createAction() {
		return view('charity/create');
	}

	public function addAction() {

		$uploader = new FileUploader();
		$file = new File('formContactFile');
		//-- voir pour formater les noms d'images fonction php faire des id uniqid()
		$filename = $file->getName();
		$uploader->upload($file, ROOT . "/public/assets/images/charity_association/" . $filename . "." . $file->getExtension());

		$sqlCreateAssociation = "INSERT INTO `charity_association`(`name`) VALUES (?)";
		if (!empty($filename)) {
			$name = $_REQUEST['formCharityName'];
			$stmt = $this->pdo->prepare("INSERT INTO `pictures`(`name`) VALUES (?)");
			$stmt->bindParam(1, $name);
			$stmt->execute();

			$result = $this->pdo->lastInsertId();
			$picture_id = intval($result);
			$sqlCreateAssociation = "INSERT INTO `charity_association`(`name`, `picture_id`) VALUES (?,?)";
		}
		//-- voir pour créer une classe Associations
		$name = $_REQUEST['formCharityName'];

//-- penser à vérifier si l'email existe déjà
		$stmt = $this->pdo->prepare($sqlCreateAssociation);
		$stmt->bindParam(1, $name);
		if (!empty($picture_id)) {
			$stmt->bindParam(10, $picture_id);
		}
		$stmt->execute();

		return view('users/create');
	}

	public function listAction() {
		

		$q = $this->pdo()->query("SELECT *,(select picture.name from picture where picture.id = charity_association.picture_id) as charity_picture FROM charity_association");
		while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
			$charities[] = $datas;
		}
		
		$url = URL;
		$app = $this->application;
		
		require ROOT . '/public/views/admin/charity/index.php';
	}

	public function viewAction() {
		$q = $this->pdo->query("SELECT *,(select pictures.name from pictures where pictures.id = charity_association.picture_id) as charity_picture FROM charity_association where id = " . intval($GLOBALS['matches'][0]));
		$charity = $q->fetch(\PDO::FETCH_ASSOC);
		return view('charity/view', compact('charity'));
	}

}
