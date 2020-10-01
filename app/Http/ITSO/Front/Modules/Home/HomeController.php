<?php

namespace Http\Itso\Front\Modules\Home;

use Epic\BaseController;

class HomeController extends BaseController {

	public function indexAction() {
		$url = URL;
		$app = $this->application;
		$user = $app->user();

		$selectionManager = new \Manager\SelectionManager($this->application->pdo());

		$selections = $selectionManager->all();

		require ROOT . '/public/views/front/home/index.php';
	}

	public function penderieAction() {

		if (!$this->application->user()->isAuthenticated()) {
			redirect($this->application->router()->getRoute('front_login'));
		}

		$url = URL;
		$app = $this->application;
		$user = $app->user();

		$productList = $this->pdo()->query("SELECT product.* FROM liked LEFT JOIN product ON (liked.product_id = product.id) WHERE liked.user_id = " . $user->getAttribute('id'))->fetchAll();
		foreach ($productList as &$product) {
			$product['pictures'] = $this->pdo()->query("SELECT picture.* FROM product_picture LEFT JOIN picture ON (product_picture.picture_id = picture.id) WHERE product_picture.product_id = " . $product['id'])->fetchAll();
			$product['user_id'] = $this->pdo()->query("SELECT user_id FROM user_product WHERE product_id = " . $product['id'])->fetchColumn();
		}

		$wishlistList = $this->pdo()->query("SELECT * FROM wishlist WHERE user_id = " . $user->getAttribute('id'))->fetchAll();
		
		foreach ($wishlistList as &$wishlist) {
			$wishlistProductList = $this->pdo()->query("SELECT product.* FROM product_wishlist LEFT JOIN product ON (product_wishlist.product_id = product.id) WHERE product_wishlist.wishlist_id = " . $wishlist['id'])->fetchAll();
			foreach ($wishlistProductList as &$wishlistProduct) {
				$wishlistProduct['pictures'] = $this->pdo()->query("SELECT picture.* FROM product_picture LEFT JOIN picture ON (product_picture.picture_id = picture.id) WHERE product_picture.product_id = " . $wishlistProduct['id'])->fetchAll();
				$wishlistProduct['user_id'] = $this->pdo()->query("SELECT user_id FROM user_product WHERE product_id = " . $wishlistProduct['id'])->fetchColumn();
			}
			$wishlist['productList'] = $wishlistProductList;
		}
		require ROOT . '/public/views/front/home/penderie.php';
	}

	public function likeAction() {

		if (!$this->application->user()->isAuthenticated()) {
			redirect($this->application->router()->getRoute('front_login'));
		}

		$url = URL;
		$app = $this->application;
		$user = $app->user();

		$productList = $this->pdo()->query("SELECT product.* FROM liked LEFT JOIN product ON (liked.product_id = product.id) WHERE liked.user_id = " . $user->getAttribute('id'))->fetchAll();
		foreach ($productList as &$product) {
			$product['pictures'] = $this->pdo()->query("SELECT picture.* FROM product_picture LEFT JOIN picture ON (product_picture.picture_id = picture.id) WHERE product_picture.product_id = " . $product['id'])->fetchAll();
			$product['user_id'] = $this->pdo()->query("SELECT user_id FROM user_product WHERE product_id = " . $product['id'])->fetchColumn();
		}

		require ROOT . '/public/views/front/home/like.php';
	}

}
