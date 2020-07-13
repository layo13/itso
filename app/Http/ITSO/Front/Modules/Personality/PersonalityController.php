<?php

namespace Http\Itso\Front\Modules\Personality;

use Epic\BaseController;

class PersonalityController extends BaseController {

	public function indexAction() {
		$url = URL;
		$app = $this->application;
		require ROOT . '/public/views/front/personality/index.php';
	}

}
