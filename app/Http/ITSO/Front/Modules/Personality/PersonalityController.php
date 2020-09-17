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

		$products = $this->pdo()->query(<<<SQL
SELECT DISTINCTROW product.*
FROM user_product
LEFT JOIN product ON (user_product.product_id = product.id)
WHERE user_product.user_id = $personalityId
ORDER BY user_product.created_at DESC
SQL
			)->fetchAll();

		foreach ($products as &$product) {
			$product['picture'] = $this->pdo()->query("SELECT picture.* FROM product_picture LEFT JOIN picture ON (product_picture.picture_id = picture.id) WHERE product_id = " . $product['id'])->fetch();
		}
		
		require ROOT . '/public/views/front/personality/read.php';
	}

	public function readFavoriteAction($id, $favorite) {

		$url = URL;
		$app = $this->application;
		$user = $app->user();

		$personality = $this->pdo()->query("SELECT * FROM user WHERE user_type_id = 2 AND id = " . (int) $id)->fetch();
		$personalityId = (int) $personality['id'];

		$favoriteCategory = $this->pdo()->query("SELECT * FROM user_favorite_category WHERE id = " . (int) $favorite)->fetch();
		$favoriteCategoryId = (int) $favoriteCategory['id'];

		$favorites = $this->pdo()->query(<<<SQL
SELECT product.* FROM user_favorite
LEFT JOIN product ON (user_favorite.product_id = product.id)
WHERE favorite_category_id = $favoriteCategoryId
SQL
			)->fetchAll();

		foreach ($favorites as &$favorite) {
			$favorite['pictures'] = $this->pdo()->query("SELECT picture.* FROM product_picture LEFT JOIN picture ON (product_picture.picture_id = picture.id) WHERE product_picture.product_id = " . (int) $favorite['id'])->fetchAll();
		}

		require ROOT . '/public/views/front/personality/favorites.php';
	}

	public function readProductAction($id, $productId) {

		$url = URL;
		$app = $this->application;
		$user = $app->user();

		$personality = $this->pdo()->query("SELECT * FROM user WHERE user_type_id = 2 AND id = " . (int) $id)->fetch();
		$personalityId = (int) $personality['id'];

		$product = $this->pdo()->query(<<<SQL
SELECT product.*
FROM user_product
LEFT JOIN product ON (user_product.product_id = product.id)
WHERE user_product.user_id = $personalityId
SQL
			)->fetch();

		var_dump($personality, $product);
	}

}
