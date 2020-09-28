<?php

namespace Http\Itso\Front\Modules\Wishlist;

use Epic\BaseController;

class WishlistController extends BaseController {

	public function indexAction() {
		$url = URL;
		$app = $this->application;
		$user = $app->user();
		require ROOT . '/public/views/front/search/index.php';
	}

	public function addAction() {
		$url = URL;
		$app = $this->application;
		$user = $app->user();

		if (!$user->isAuthenticated()) {
			header("Content-Type: application/json; Charset=UTF-8");
			return json_encode([
				'user_authenticated' => $user->isAuthenticated()
				], JSON_PRETTY_PRINT);
		} else {
			$name = $_REQUEST['name'];
			header("Content-Type: application/json; Charset=UTF-8");
			$this->pdo()->prepare("INSERT INTO wishlist (name, user_id) VALUES (?, ?)")->execute([$name, $user->getAttribute('id')]);
			return json_encode([
				'wishlist' => [
					'id' => $this->pdo()->lastInsertId(),
					'name' => $name
				],
				'user_authenticated' => $user->isAuthenticated()
			], JSON_PRETTY_PRINT);
		}
	}
	public function addProductAction() {
		$url = URL;
		$app = $this->application;
		$user = $app->user();

		if (!$user->isAuthenticated()) {
			header("Content-Type: application/json; Charset=UTF-8");
			return json_encode([
				'user_authenticated' => $user->isAuthenticated()
				], JSON_PRETTY_PRINT);
		} else {
			
			$wishlistId = $_REQUEST['wishlist'];
			$productId = $_REQUEST['product'];
			$operation = $_REQUEST['operation'];
			
			if ($operation == 'add') {
				$count = $this->pdo()->query("SELECT COUNT(*) FROM product_wishlist WHERE product_id = $productId AND wishlist_id = $wishlistId")->fetchColumn();
				if (!$count) {
					$operation = $this->pdo()->prepare("INSERT INTO product_wishlist (product_id, wishlist_id) VALUES (?, ?)")->execute([$productId, $wishlistId]);
				}
			} else {
				$operation = $this->pdo()->prepare("DELETE FROM product_wishlist WHERE product_id = ? AND wishlist_id = ?")->execute([$productId, $wishlistId]);
			}
			header("Content-Type: application/json; Charset=UTF-8");
			return json_encode([
				'user_authenticated' => $user->isAuthenticated(),
				'operation' => $operation
			], JSON_PRETTY_PRINT);
		}
	}

}
