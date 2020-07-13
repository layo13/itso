<?php

namespace Http\Itso\Admin\Modules\Charity;

use Epic\Upload\File;
use Epic\Upload\FileUploader;
use Epic\BaseController;

class CharityController extends BaseController {

	public function createAction() {
        $url = URL;
        $app = $this->application;
        require ROOT . '/public/views/admin/charity/create.php';
	}

	public function updateAction($id) {
        $url = URL;
        $app = $this->application;
        $q = $this->pdo()->query("SELECT charity_association.*,picture.name as charity_picture FROM charity_association LEFT JOIN picture ON (picture.id = charity_association.picture_id) where charity_association.id = " . intval($id));
        $charity = $q->fetch(\PDO::FETCH_ASSOC);

        require ROOT . '/public/views/admin/charity/update.php';
	}

	public function editAction($id) {
        $url = URL;
        $app = $this->application;

        $q = $this->pdo()->query("SELECT * FROM charity_association where charity_association.id = " . intval($id));
        $charity = $q->fetch(\PDO::FETCH_ASSOC);
        $picture_id = $charity['picture_id'];

		$uploader = new FileUploader();
		$file = new File('formCharityFile');
		//-- voir pour formater les noms d'images fonction php faire des id uniqid()
		$filename = $file->getName();

		if (!empty($filename)) {
            $rqtDelete = 'DELETE FROM `picture` WHERE id = ?';
            $stmt = $this->pdo()->prepare($rqtDelete)->execute([$picture_id]);
            $uploader->upload($file, ROOT . "/public/assets/images/charity_association/" . $filename . "." . $file->getExtension());
			$name = $filename;
			$stmt = $this->pdo()->prepare("INSERT INTO `picture`(`name`) VALUES (?)");
			$stmt->bindParam(1, $name);
			$stmt->execute();

			$result = $this->pdo()->lastInsertId();
			$picture_id = intval($result);
		}
		//-- voir pour créer une classe Associations
		$name = $_REQUEST['formCharityName'];
		$active = $_REQUEST['formCharityActive'];

        $sqlUpdateUser ="UPDATE `charity_association` SET name = ?, picture_id = ?, active = ? WHERE id=?";
        $stmt = $this->pdo()->prepare($sqlUpdateUser)->execute([$name,$picture_id,$active,$id]);

        redirect($app->router()->getRoute('admin_charity_list'));
	}

	public function addAction() {
        $url = URL;
        $app = $this->application;
		$uploader = new FileUploader();
		$file = new File('formCharityFile');
		//-- voir pour formater les noms d'images fonction php faire des id uniqid()
		$filename = $file->getName();

		$sqlCreateAssociation = "INSERT INTO `charity_association`(`name`,`active`) VALUES (?,?)";
		if (!empty($filename)) {
            $uploader->upload($file, ROOT . "/public/assets/images/charity_association/" . $filename . "." . $file->getExtension());
			$name = $filename;
			$stmt = $this->pdo()->prepare("INSERT INTO `picture`(`name`) VALUES (?)");
			$stmt->bindParam(1, $name);
			$stmt->execute();

			$result = $this->pdo()->lastInsertId();
			$picture_id = intval($result);
			$sqlCreateAssociation = "INSERT INTO `charity_association`(`name`,`active`,`picture_id`) VALUES (?,?,?)";
		}
		//-- voir pour créer une classe Associations
		$name = $_REQUEST['formCharityName'];
        $active = $_REQUEST['formCharityActive'];

        //-- penser à vérifier si l'email existe déjà
		$stmt = $this->pdo()->prepare($sqlCreateAssociation);
		$stmt->bindParam(1, $name);
        $stmt->bindParam(2, $active);
		if (!empty($picture_id)) {
			$stmt->bindParam(3, $picture_id);
		}
		$stmt->execute();

        redirect($app->router()->getRoute('admin_charity_list'));
	}

	public function listAction() {
        $url = URL;
        $app = $this->application;
		$q = $this->pdo()->query("SELECT charity_association.*,picture.name as charity_picture FROM charity_association LEFT JOIN picture ON (picture.id = charity_association.picture_id) order by name asc");
		while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
			$charities[] = $datas;
		}

		require ROOT . '/public/views/admin/charity/index.php';
	}

	public function viewAction($id) {
        $url = URL;
        $app = $this->application;
		$q = $this->pdo()->query("SELECT charity_association.*,picture.name as charity_picture FROM charity_association LEFT JOIN picture ON (picture.id = charity_association.picture_id) where charity_association.id = " . intval($id));
		$charity = $q->fetch(\PDO::FETCH_ASSOC);

        require ROOT . '/public/views/admin/charity/view.php';
	}

}
