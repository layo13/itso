<?php

namespace Http\Itso\Admin\Modules\Home;

use Epic\BaseController;

class HomeController extends BaseController {

	public function indexAction() {
		$url = 'http://localhost/itso/';

		require ROOT . '/public/views/admin/home/index.php';
	}

}
