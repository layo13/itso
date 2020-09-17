<?php

namespace Http\Itso\Front\Modules\Brand;

use Epic\BaseController;

class ProductController extends BaseController {

	public function indexAction() {
		$url = URL;
		$app = $this->application;
		require ROOT . '/public/views/front/product/index.php';
	}

	public function readAction($id) {
		$url = URL;
		$app = $this->application;

		$brand = $this->pdo()->query("SELECT * FROM product WHERE id = " . (int) $id);

		require ROOT . '/public/views/front/product/read.php';
	}

}
