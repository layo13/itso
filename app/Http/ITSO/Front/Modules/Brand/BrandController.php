<?php

namespace Http\Itso\Front\Modules\Brand;

use Epic\BaseController;

class BrandController extends BaseController {

	public function indexAction() {
		$url = URL;
		$app = $this->application;
		require ROOT . '/public/views/front/brand/index.php';
	}

}
