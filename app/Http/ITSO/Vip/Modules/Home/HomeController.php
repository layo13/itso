<?php

namespace Http\Itso\Vip\Modules\Home;

use Epic\BaseController;

class HomeController extends BaseController {

	public function indexAction() {
		$url = URL;
		$app = $this->application;
		require ROOT . '/public/views/vip/home/index.php';
	}

}
