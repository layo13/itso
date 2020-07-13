<?php

namespace Http\Itso\Front\Modules\Home;

use Epic\BaseController;

class HomeController extends BaseController {

	public function indexAction() {
		$url = URL;
		$app = $this->application;
		$user = $app->user();
		require ROOT . '/public/views/front/home/index.php';
	}

}
