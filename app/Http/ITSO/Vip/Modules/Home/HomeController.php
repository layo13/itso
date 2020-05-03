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

        $q = $this->pdo()->query("
        SELECT count(*) as nb_subscriber
        FROM subscription where member_id <> " . intval($app->user()->getAttribute('id')). " and celebrity_id = " . intval($app->user()->getAttribute('id'))." group by celebrity_id");
        $nbSubscriber = $q->fetch(\PDO::FETCH_ASSOC);

        $nbProductLike = [];
        $q = $this->pdo()->query("select sum(nb) as nb_product_like from (SELECT count(*) as nb FROM liked where product_id in ( select product_id from user_product where user_id = " .intval($app->user()->getAttribute('id')).") and user_id <> ".intval($app->user()->getAttribute('id'))." group by product_id) as tab");
        $nbTotalLike = $q->fetch(\PDO::FETCH_ASSOC);

		require ROOT . '/public/views/vip/home/index.php';
	}
    public function contactAction()
    {
        $url = URL;
        $app = $this->application;

        require ROOT . '/public/views/vip/home/contact.php';
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