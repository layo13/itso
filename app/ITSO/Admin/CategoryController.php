<?php

namespace ITSO\Admin;

class CategoryController extends \Epic\BaseController {

	public function homeAction() {

		$message = "Salut";
		
		return view('category/home', compact('message'));
	}

}
