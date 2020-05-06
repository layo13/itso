<?php

namespace Http\Itso\Admin\Modules\Color;

use Epic\BaseController;

class ColorController extends BaseController {

	public function createAction() {
        $url = URL;
        $app = $this->application;
        require ROOT . '/public/views/admin/color/create.php';
	}

	public function updateAction() {
        $url = URL;
        $app = $this->application;
        if(empty($GLOBALS['matches'])){
            $GLOBALS['matches'][0]=2;
        }

        $q = $this->pdo()->query("SELECT * FROM color where id = " . intval($GLOBALS['matches'][0]));
        $color = $q->fetch(\PDO::FETCH_ASSOC);
        require ROOT . '/public/views/admin/color/update.php';
	}

	public function editAction() {
        $url = URL;
        $app = $this->application;

		$name = $_REQUEST['formColorName'];
		$hex = $_REQUEST['formColorHex'];
        $id = intval($GLOBALS['matches'][0]);

        $sqlUpdateUser ="UPDATE `color` SET name = ?, hex = ? WHERE id=?";
        $stmt = $this->pdo()->prepare($sqlUpdateUser)->execute([$name,$hex,$id]);

        redirect($app->router()->getRoute('admin_color_list'));
	}

	public function addAction() {
        $url = URL;
        $app = $this->application;

        $sqlCreateAssociation = "INSERT INTO `color`(`name`,`hex`) VALUES (?,?)";
        $name = $_REQUEST['formColorName'];
        $hex = $_REQUEST['formColorHex'];

		$stmt = $this->pdo()->prepare($sqlCreateAssociation);
		$stmt->bindParam(1, $name);
        $stmt->bindParam(2, $hex);
		$stmt->execute();

        redirect($app->router()->getRoute('admin_color_list'));
	}

	public function listAction() {
        $url = URL;
        $app = $this->application;
		$q = $this->pdo()->query("SELECT * FROM color");
		while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
			$colors[] = $datas;
		}

		require ROOT . '/public/views/admin/color/index.php';
	}
}
