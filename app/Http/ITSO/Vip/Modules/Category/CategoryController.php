<?php

namespace Http\Itso\Vip\Modules\Category;

use Epic\BaseController;

class CategoryController extends BaseController {

	public function homeAction() {

		$message = "Salut";
		
		return view('category/home', compact('message'));
	}

	public function selectAction() {

        $q = $this->pdo()->query("SELECT * FROM product_category where parent_id = ". $_REQUEST['parent_id']);
        //-- faire la gestion de tableau multi-dimensionnelle
        $value = "<select class=\"form-control formChoixChild\" name=\"formCategoryProduct\">";
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $value .= "<option value=\"" . $datas['id'] . "\">" . $datas['name'] . "</option>";
        }
        $value .= "</select>";
		return $value;
	}

}
