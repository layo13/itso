<?php

namespace Http\Itso\Front\Modules\Personality;

use Epic\BaseController;

class PersonalityController extends BaseController {

    public function indexAction() {
        $url = URL;
        $app = $this->application;
        $user = $app->user();
        require ROOT . '/public/views/front/personality/index.php';
    }

    public function readAction($id) {
        $url = URL;
        $app = $this->application;
        $user = $app->user();

        $personality = $this->pdo()->query("SELECT * FROM user WHERE user_type_id = 2 AND id = " . (int) $id)->fetch();
        $personalityId = (int) $personality['id'];

        $personalityPicture = null;
        if (!empty($personality['picture_id'])) {
            $personalityPicture = $this->pdo()->query("SELECT * FROM picture WHERE id = " . (int) $personality['picture_id'])->fetch();
        }

        $favoriteCategories = $this->pdo()->query(<<<SQL
SELECT user_favorite_category.* FROM user_favorite_category
RIGHT JOIN user_favorite ON (user_favorite_category.id = user_favorite.favorite_category_id)
WHERE user_id = $personalityId
GROUP BY user_favorite_category.id
SQL
    )->fetchAll();
        $subscriptions = $this->pdo()->query("SELECT COUNT(*) FROM subscription WHERE celebrity_id = " . (int) $personality['id'])->fetchColumn();

        $charity = null;
        if (!empty($personality['charity_id'])) {
            $charity = $this->pdo()->query("SELECT * FROM charity_association WHERE id = " . (int) $personality['charity_id'])->fetch();
        }
        require ROOT . '/public/views/front/personality/read.php';
    }
    
    public function readFavoriteAction($id, $favorite) {
        var_dump($id, $favorite);exit;
    }

}
