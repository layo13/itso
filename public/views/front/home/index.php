<?php
//---------------//
// BLOCK CONTENT //
//---------------//

/** @var Epic\BaseApplication $app */
$app;

ob_start();
?>

<div class="row">
	<div class="col-12">
		<div class="card bg-light text-dark mt-3">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="text-left mb-0">123.456.789&euro;</h5>
					</div>
					<div class="col">
						<p class="text-right mb-0">
							<a href="#">Actualités</a>
						</p>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12">
		<p class="text-center tt_dons mt-2"><i class="fa fa-heart"></i> Totalité des dons récoltés en 2020</p>
	</div>
</div>

<?php foreach ($selections as $selection) { ?>

    <div class="row">
        <div class="col-12">
            <h4 class="title_rubrique"><?= $selection['label'] ?></h4>
        </div>
    </div>

    <div class="row mb-2">
        <?php foreach($selection['items'] as $item) {
            $itemSrc = URL . "public/assets/images/no-image-available.jpg";
            $itemAlt = "Non renseigné";
            $itemClass = "";
            if ($selection['target'] == 'user') {
				$link = $app->router()->getRoute('front_personality_read', ['id' => $item['id']]);
                if (!empty($item['picture'])) {
                    $itemSrc = URL . "public/assets/images/user/" . $item['picture'];
                    $itemAlt = $item['first_name'] .' '. $item['last_name'];
                    $itemClass = "profil_acc rounded-circle ";
                    $blockItemClass = "col-2";
                    $itemClassDesc = "sub_desc";
                }
            } else if ($selection['target'] == 'product') {
				$link = $app->router()->getRoute('front_personality_product_read', [
					'id' => $item['user']['id'],
					'product' => $item['id']
				]);
                if (!empty($item['picture'])) {
                    $itemSrc = URL . "public/assets/images/product/" . $item['picture'];
                    $itemAlt = $item['name'];
                }
                $blockItemClass = "col-3";
                $itemClassDesc = "product_desc";
            } ?>
            <div class="<?= $blockItemClass ?>">
				<a class="text-decoration-none" href="<?= $link ?>">
                    <div class="<?= $itemClass ?>img-cube-container" style="background: url('<?= $itemSrc ?>');background-position: center;background-size: cover;background-repeat: no-repeat;" title="<?= $itemAlt ?>"></div>
                    <div class="<?= $itemClassDesc ?>"><?= $itemAlt ?></div>
				</a>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
