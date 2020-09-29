<?php
//---------------//
// BLOCK CONTENT //
//---------------//

/* @var $app Epic\BaseApplication */
$app;
/** @var Epic\User $user */
$user;

ob_start();
?>

<?php if (!empty($productList)) { ?>
	<h2>Produits likés</h2>
	<div class="row">
		<?php foreach ($productList as $product) { ?>
			<div class="col-4">
				<a href="<?= $app->router()->getRoute('front_personality_product_read', [
					'id' => $product['user_id'],
					'product' => $product['id']
				])
				?>">
					<?php if (empty($product['pictures'][0])) { ?>
						<img class="img-fluid" src="<?= URL ?>public/assets/images/no-image-available.jpg" />
					<?php } else { ?>
						<img class="img-fluid" src="<?= URL ?>public/assets/images/product/<?= $product['pictures'][0]['name'] ?>" />
					<?php } ?>
				</a>
			</div>
		<?php } ?>
	</div>
<?php } ?>

<?php if (!empty($wishlistList)) { ?>
	<h2>Wishlists</h2>
	<?php foreach ($wishlistList as $wishlistBis) { ?>

		<h3><?= $wishlistBis['name'] ?></h3>
		<div class="row">
			<?php foreach ($wishlistBis['productList'] as $productBis) { ?>
				<div class="col-4">
					<a href="<?= $app->router()->getRoute('front_personality_product_read', [
						'id' => $productBis['user_id'],
						'product' => $productBis['id']
					]) ?>">
						<?php if (empty($product['pictures'][0])) { ?>
							<img class="img-fluid" src="<?= URL ?>public/assets/images/no-image-available.jpg" />
						<?php } else { ?>
							<img class="img-fluid" src="<?= URL ?>public/assets/images/product/<?= $productBis['pictures'][0]['name'] ?>" />
						<?php } ?>
					</a>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
<?php } ?>

<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
