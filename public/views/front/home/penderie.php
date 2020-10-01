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
<?php if (!empty($wishlistList)) { ?>
	<h2 class="title_artist">Wishlists</h2>
	<?php foreach ($wishlistList as $wishlistBis) { ?>

		<h3 class="title_rubrique"><?= $wishlistBis['name'] ?></h3>
		<div class="row">
			<?php foreach ($wishlistBis['productList'] as $productBis) { ?>
				<div class="col-4">
					<a class="text-decoration-none" href="<?= $app->router()->getRoute('front_personality_product_read', [
						'id' => $productBis['user_id'],
						'product' => $productBis['id']
					]) ?>">
                        <?php
                        if (empty($product['pictures'][0]['name'])) {
                            $itemSrc = URL."public/assets/images/no-image-available.jpg";
                        } else {
                            $itemSrc = URL."public/assets/images/product/". $product['pictures'][0]['name'];
                        }
                        ?>
                        <div class="img-cube-container" style="background: url('<?= $itemSrc ?>');background-position: center;background-size: cover;background-repeat: no-repeat;"></div>
                        <div class="product_desc"><?= $product['name']?></div>
					</a>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
<?php } ?>

<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
