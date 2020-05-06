<?php

namespace Http\Itso\Vip\Modules\Brand;

use Epic\Upload\File;
use Epic\Upload\FileUploader;
use Epic\BaseController;

class BrandController extends BaseController {

	public function listAction() {
        $url = URL;
        $app = $this->application;
		$q = $this->pdo()->query("SELECT brand.*, picture.name as brand_picture FROM brand LEFT JOIN picture ON (picture.id = brand.picture_id)");
		while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
			$brands[] = $datas;
		}
		//return view('brand/list', compact('brand'));

		
		require ROOT . '/public/views/vip/brand/index.php';
	}

	public function viewAction() {
        $url = URL;
        $app = $this->application;
		$q = $this->pdo()->query("SELECT brand.*, picture.name as brand_picture FROM brand LEFT JOIN picture ON (picture.id = brand.picture_id) where id = " . intval($GLOBALS['matches'][0]));
		$brand = $q->fetch(\PDO::FETCH_ASSOC);
        require ROOT . '/public/views/vip/brand/view.php';
	}

}
