<?php

namespace Http\Itso\Admin;

class CategoryController extends \Epic\BaseController {

	public function homeAction() {

		$message = "Salut";
		
		return view('category/home', compact('message'));
	}

}
