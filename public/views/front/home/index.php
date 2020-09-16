<?php
//---------------//
// BLOCK CONTENT //
//---------------//

ob_start();
?>

<div class="row">
	<div class="col-12">
		<div class="card bg-light text-dark mt-3">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="text-left">123.456.789&euro;</h5>
					</div>
					<div class="col">
						<p class="text-right">
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
		<p class="text-center"><i class="fa fa-heart"></i> Totalité des dons récoltés en 2020</p>
	</div>
</div>

<?php foreach ($selections as $selection) { ?>

    <div class="row">
        <div class="col-12">
            <h6><?= $selection['label'] ?></h6>
        </div>
    </div>

    <div class="row">
        <?php foreach($selection['items'] as $item) {
            $itemSrc = URL . "public/assets/images/no-image-available.jpg";
            $itemAlt = "Non renseigné";
            if ($selection['target'] == 'user') {
                if (!empty($item['picture'])) {
                    $itemSrc = URL . "public/assets/images/user/" . $item['picture'];
                    $itemAlt = $item['first_name'] .' '. $item['last_name'];
                }
            } else if ($selection['target'] == 'product') {
                if (!empty($item['picture'])) {
                    $itemSrc = URL . "public/assets/images/product/" . $item['picture'];
                    $itemAlt = $item['name'];
                }
            } ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="img-cube-container" style="background: url('<?= $itemSrc ?>');background-position: center;background-size: cover;background-repeat: no-repeat;" title="<?= $itemAlt ?>"></div>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
