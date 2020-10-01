<?php
//---------------//
// BLOCK CONTENT //
//---------------//

/** @var Epic\BaseApplication $app */
$app;

ob_start();
?>
    <div class="row">
        <div class="col-2">
            <?php if (!empty($personalityPicture)) { ?>
                <a href="<?= $app->router()->getRoute('front_personality_read', ['id' => $personalityId]) ?>">
                    <img class="rounded-circle d-block profile_read_first" src="<?= $url ?>public/assets/images/user/<?= $personalityPicture['name'] ?>"/>
                </a>
            <?php } ?>
        </div>
        <div class="col-5 text-sm-left">
            <h2 class="title_artist"><?= $personality['first_name'] ?> <?= $personality['last_name'] ?></h2>
            <span class="nb_abonnee"><i class="fa fa-heart"></i> <?= $subscriptions ?> Abonné(s)</span>
            <button id="btnSubscribe" type="button" class="btn btn-secondary <?= $btnClass ?>">
                <?= ($btnClass == 'active' ? "ABONNÉ(E)" : "S'ABONNER") ?>
            </button>

        </div>
        <div class="col-5 text-sm-right">
            <?php if (!empty($charity)) { ?>
                <?= $personality['first_name'] ?> soutient <?= $charity['name'] ?>
            <?php } ?>
        </div>
    </div>
<hr />
<div class="row">
    <div class="col-12">
        <h4 class="title_rubrique">Articles les plus humanitaires</h4>
    </div>
</div>

<?php if (!empty($favoriteCategories)) { ?>
	<div class="row">
		<div class="col-12">
			<h4 class="title_rubrique">Parcourir tout</h4>
		</div>
	</div>
	<div class="row">
		<?php foreach ($favoriteCategories as $favoriteCategory) { ?>
			<div class="col-4">
				<a class="text-decoration-none" href="<?= $app->router()->getRoute('front_personality_favority_read', ['id' => $personality['id'], 'favorite' => $favoriteCategory['id']]) ?>">
					<div class="card">
						<div style="color: #333;" class="card-body">
							<?= $favoriteCategory['name'] ?>
						</div>
					</div>
				</a>
			</div>
		<?php } ?>
	</div>
<?php } ?>

<?php if (!empty($products)) { ?>
	<div class="row">
		<?php foreach ($products as $product) { ?>
			<div class="col-3">
				<a class="text-decoration-none" title="Voir le produit" href="<?= $app->router()->getRoute('front_personality_product_read', [
					'id' => $personality['id'],
					'product' => $product['id']
				])
				?>">
					<?php
                    if (empty($product['picture'])) {
                        $itemSrc = URL."public/assets/images/no-image-available.jpg";
					} else {
                        $itemSrc = URL."public/assets/images/product/". $product['picture']['name'];
                    }
                    ?>
                    <div class="img-cube-container" style="background: url('<?= $itemSrc ?>');background-position: center;background-size: cover;background-repeat: no-repeat;"></div>
                    <div class="product_desc"><?= $product['name']?></div>
				</a>
			</div>
	<?php } ?>
	</div>
<?php } ?>

<?php
$blockContent = ob_get_clean();






//---------------//
// BLOCK JS //
//---------------//

ob_start();
?>
<script>
	
	 var personalityRead = function () {
        var o = this;
        o.init();
    };

	personalityRead.prototype = {
        init: function () {
            var o = this;
            o.handleEvents();
		},
        handleEvents: function () {
            var o = this;

			$('#btnSubscribe').click(function(){
				var btn = $(this);

				var suscribe = !$(this).hasClass("active") ? 1 : 0;

				$.ajax({
					type: "POST",
					url: "<?= $app->router()->getRoute('front_personality_suscribe_ajax', [
						'id' => $personality['id']
					]) ?>",
					data: {
						suscribe: suscribe
					},
					dataType: 'JSON',
					success: function (data) {
						if (data.user_authenticated == false){
							buildConnectOrRegisterModal('myModal');
						} else {
							if (data.content == 'subscribed'){
								$(btn).addClass('active')
									.html("Abonné(e)");
							} else {
								$(btn).removeClass('active')
									.html("S'abonner");
							}
						}
					}
				});
			});
		}
	};
	new personalityRead();

</script>
<?php
$blockJs = ob_get_clean();

require __DIR__ . '/../base.php';
