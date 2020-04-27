<?php

namespace Http\Itso\Admin\Modules\Home;

use Epic\BaseController;

class HomeController extends BaseController {

	public function indexAction() {
		$url = URL;
		$app = $this->application;
		require ROOT . '/public/views/admin/home/index.php';
	}

}
