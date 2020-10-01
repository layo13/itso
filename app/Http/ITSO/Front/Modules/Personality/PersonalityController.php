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

		$btnClass = "";
		if ($user->isAuthenticated()) {
			$count = $this->pdo()->query("SELECT COUNT(*) FROM subscription WHERE celebrity_id = " . (int) $personality['id'] . " AND member_id = " . (int) $user->getAttribute('id'))->fetchColumn();
			if ($count) {
				$btnClass = 'active';
			}
		}

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

		$personalityPicture = null;
		if (!empty($personality['picture_id'])) {
			$personalityPicture = $this->pdo()->query("SELECT * FROM picture WHERE id = " . (int) $personality['picture_id'])->fetch();
		}

		$subscriptions = $this->pdo()->query("SELECT COUNT(*) FROM subscription WHERE celebrity_id = " . (int) $personality['id'])->fetchColumn();

		$charity = null;
		if (!empty($personality['charity_id'])) {
			$charity = $this->pdo()->query("SELECT * FROM charity_association WHERE id = " . (int) $personality['charity_id'])->fetch();
		}

		$product = $this->pdo()->query(<<<SQL
SELECT product.*
FROM user_product
LEFT JOIN product ON (user_product.product_id = product.id)
WHERE user_product.user_id = $personalityId
AND product.id = $productId
SQL
			)->fetch();

		$product['pictures'] = $this->pdo()->query("SELECT `picture`.* FROM `product_picture` LEFT JOIN `picture` ON (`product_picture`.`picture_id` = `picture`.`id`) WHERE `product_picture`.`product_id` = " . $product['id'])->fetchAll();

		$likeClass = "";
		if ($user->isAuthenticated()) {
			$like = $this->pdo()->query("SELECT * FROM liked WHERE user_id = " . $user->getAttribute('id') . " AND product_id = " . $productId)->fetch();
			if ($like) {
				$likeClass = "active";
			}
		}

        $btnClass = "";
        if ($user->isAuthenticated()) {
            $count = $this->pdo()->query("SELECT COUNT(*) FROM subscription WHERE celebrity_id = " . (int) $personality['id'] . " AND member_id = " . (int) $user->getAttribute('id'))->fetchColumn();
            if ($count) {
                $btnClass = 'active';
            }
        }
		require ROOT . '/public/views/front/personality/product/read.php';
	}

	public function suscribeAction($id) {

		$url = URL;
		$app = $this->application;
		$user = $app->user();

		$personality = $this->pdo()->query("SELECT * FROM user WHERE user_type_id = 2 AND id = " . (int) $id)->fetch();
		$personalityId = (int) $personality['id'];


		if (!$user->isAuthenticated()) {
			header("Content-Type: application/json; Charset=UTF-8");
			return json_encode([
				'user_authenticated' => $user->isAuthenticated()
				], JSON_PRETTY_PRINT);
		} else {
			$response = [
				"state" => "success",
				'user_authenticated' => $user->isAuthenticated()
			];

			$suscribe = (int) $_REQUEST['suscribe'];

			if ($suscribe) {
				$count = $this->pdo()->query("SELECT COUNT(*) FROM subscription WHERE member_id = " . $user->getAttribute('id') . " AND celebrity_id = " . $personality['id'])->fetchColumn();
				if ($count) {
					$response["content"] = "subscribed";
				} else {
					// INSERT
					$stmt = $this->pdo()->prepare("INSERT INTO subscription (member_id, celebrity_id) VALUES (?, ?)");
					$stmt->execute([$user->getAttribute('id'), $personality['id']]);
					$response["content"] = "subscribed";
				}
			} else { // on desabonne
				$stmt = $this->pdo()->prepare("DELETE FROM subscription WHERE member_id = ? AND celebrity_id = ?");
				$stmt->execute([$user->getAttribute('id'), $personality['id']]);
				$response["content"] = "not_subscribed";
			}
			header("Content-Type: application/json; Charset=UTF-8");
			return json_encode($response, JSON_PRETTY_PRINT);
		}
	}

	/**
	 * @todo Revoir l'algo JS + PHP
	 * 
	 * @param type $id
	 * @param type $productId
	 * @return type
	 */
	public function readProductLikeAction($id, $productId) {

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
AND product.id = $productId
SQL
			)->fetch();


		if (!$user->isAuthenticated()) {
			header("Content-Type: application/json; Charset=UTF-8");
			return json_encode([
				'like' => $_REQUEST['like'],
				'user_authenticated' => $user->isAuthenticated()
				], JSON_PRETTY_PRINT);
		} else {
			$response = [
				"state" => "success",
				'user_authenticated' => $user->isAuthenticated()
			];

			$like = (int) $_REQUEST['like'];

			if ($like) {

				$count = $this->pdo()->query("SELECT COUNT(*) FROM liked WHERE user_id = " . $user->getAttribute('id') . " AND product_id = " . $product['id'])->fetchColumn();
				if ($count) {
					$response["content"] = "liked";
				} else {
					// INSERT
					$stmt = $this->pdo()->prepare("INSERT INTO liked (user_id, product_id) VALUES (?, ?)");
					$stmt->execute([$user->getAttribute('id'), $product['id']]);
					$response["content"] = "liked";
				}
			} else { // on delike
				$stmt = $this->pdo()->prepare("DELETE FROM liked WHERE user_id = ? AND product_id = ?");
				$stmt->execute([$user->getAttribute('id'), $product['id']]);
				$response["content"] = "not_liked";
			}
			header("Content-Type: application/json; Charset=UTF-8");
			return json_encode($response, JSON_PRETTY_PRINT);
		}
	}

	public function readProductAddToWishlistAction($id, $productId) {

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
AND product.id = $productId
SQL
			)->fetch();

		if (!$user->isAuthenticated()) {
			header("Content-Type: application/json; Charset=UTF-8");
			return json_encode([
				'user_authenticated' => $user->isAuthenticated()
				], JSON_PRETTY_PRINT);
		} else {
			$response = [
				"state" => "success",
				'user_authenticated' => $user->isAuthenticated()
			];

			$wishlists = $this->pdo()->query("SELECT * FROM wishlist WHERE user_id = " . $user->getAttribute('id'))->fetchAll();

			$wishlistsJson = [];

			foreach ($wishlists as $wishlist) {

				$wishlistsJson[] = [
					'id' => $wishlist['id'],
					'name' => $wishlist['name'],
					'in' => $this->pdo()->query("SELECT COUNT(*) FROM product_wishlist WHERE product_id = $productId AND wishlist_id = " . $wishlist['id'])->fetchColumn() ? true : false
				];
			}

			$response['content'] = $wishlistsJson;

			header("Content-Type: application/json; Charset=UTF-8");
			return json_encode($response, JSON_PRETTY_PRINT);
		}
	}

	public function getLinksAction($id, $productId) {
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
AND product.id = $productId
SQL
			)->fetch();

		$productLinks = $this->pdo()->query("SELECT * FROM product_link WHERE product_id = " . $productId)->fetchAll();

		$content = [];

		foreach ($productLinks as $productLink) {
			$content[] = ['host' => parse_url($productLink['url'], PHP_URL_HOST),
				'url' => $productLink['url']
			];
		}

		$response = [
			"state" => "success",
			'user_authenticated' => $user->isAuthenticated(),
			'content' => $content
		];

		header("Content-Type: application/json; Charset=UTF-8");
		return json_encode($response, JSON_PRETTY_PRINT);
	}

}
