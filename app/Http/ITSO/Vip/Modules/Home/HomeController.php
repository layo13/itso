<?php

namespace Http\Itso\Vip\Modules\Home;

use Epic\BaseController;

class HomeController extends BaseController {

	public function indexAction() {
		$url = URL;
		$app = $this->application;
        $q = $this->pdo()->query("
SELECT user.*, celebrity_category.name as category_name, picture.name picture_name 
FROM user
LEFT JOIN user_celebrity_category ON user.id = user_celebrity_category.user_id
LEFT JOIN celebrity_category ON user_celebrity_category.celebrity_category_id = celebrity_category.id
LEFT JOIN picture ON user.picture_id = picture.id
where
user.id = " . intval($app->user()->getAttribute('id')));
        $user = $q->fetch(\PDO::FETCH_ASSOC);
		require ROOT . '/public/views/vip/home/index.php';
	}

}

/*"
SELECT user.*, picture.name picture_name 
FROM user, picture
where picture.id = picture_id AND 
user.id = 3

SELECT user.*, celebrity_category.name as category_name, picture.name picture_name 
FROM user, picture,celebrity_category,user_celebrity_category 
where picture.id = picture_id AND 
user_celebrity_category.celebrity_category_id = celebrity_category.id AND 
user_celebrity_category.user_id = user.id AND 
user.id = 3

SELECT user.*, celebrity_category.name as category_name, picture.name picture_name
FROM user
LEFT JOIN user_celebrity_category ON user.id = user_celebrity_category.user_id
LEFT JOIN celebrity_category ON user_celebrity_category.celebrity_category_id = celebrity_category.id
LEFT JOIN picture ON user.picture_id = picture.id
"
*/