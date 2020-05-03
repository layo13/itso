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

        $qParent = $this->pdo()->query("SELECT id,name,parent_id FROM product_category where parent_id = ". $_REQUEST['parent_id']);
        //-- faire la gestion de tableau multi-dimensionnelle
        while ($datas = $qParent->fetch(\PDO::FETCH_ASSOC)) {
            $product_category[$datas['id']]['value'] = $datas;
        }
        $qChildrens = $this->pdo()->query("select id,name,parent_id from product_category where parent_id in (SELECT id FROM product_category where parent_id =". $_REQUEST['parent_id'].")");
        while ($datas = $qChildrens->fetch(\PDO::FETCH_ASSOC)) {
            $product_category[$datas['parent_id']]['children'][$datas['id']]['value'] = $datas;
        }

        //-- faire la gestion de tableau multi-dimensionnelle
        $value = "<select class=\"form-control formChoixChild\" name=\"formCategoryProduct\">";
        foreach($product_category as $category ){
            if(empty($category['children'])){
                $value .= "<option value=\"". $category['value']['id']."\">". utf8_encode($category['value']['name'])."</option>";
            }else{
                $value .= "<optgroup label=\"". utf8_encode($category['value']['name'])."\">";
                foreach($category['children'] as $child ){
                    $value .= "<option value=\"". $child['value']['id']."\">". utf8_encode($child['value']['name'])."</option>";
                }
                $value .= "</optgroup>";
            }
        }
        $value .= "</select>";
		return $value;
	}

}
