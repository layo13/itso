<?php
//---------------//
// BLOCK CONTENT //
//---------------//

/** @var Epic\BaseApplication $app */
$app;

ob_start();
?>

<?php require __DIR__.'/../heading.php'; ?>

<hr />

<div class="row">
    <div class="col-12">
        <?php
			// var_dump($personality, $product);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-6">		
		<img class="img-fluid" src="<?= $url ?>public/assets/images/product/<?= $product['pictures'][0]['name'] ?>" alt="<?= $product['name'] ?>" />
    </div>
    <div class="col-3">
        
		<?php foreach($product['pictures'] as $picture){ ?>
			<div class="row">
				<div class="col-12">
					<img class="img-fluid" src="<?= $url ?>public/assets/images/product/<?= $picture['name'] ?>" alt="<?= $product['name'] ?>" />
				</div>
			</div>
		<?php } ?>
		
    </div>
    <div class="col-3">
        <div class="btn-group-vertical" role="group" aria-label="Basic example">
			<?php // LIKE ?>
			<button id="btnLike" type="button" class="btn btn-secondary <?= $likeClass ?>"><i class="fa fa-heart fa-2x"></i></button>
			<?php // AJOUTER A UNE PLAYLIST ?>
			<button id="btnAddToWishList" type="button" class="btn btn-secondary"><i class="fa fa-plus fa-2x"></i></button>
			<?php // ACHETER ?>
			<button id="btnBuy" type="button" class="btn btn-secondary"><i class="fa fa-shopping-cart fa-2x"></i></button>
			<?php
			/*
			<!-- C'est juste pour garder les identifiants des icons font awesome -->
			<button type="button" class="btn btn-secondary"><i class="fa fa-person-booth fa-2x"></i></button>
			<button type="button" class="btn btn-secondary"><i class="fa fa-map-marked-alt fa-2x"></i></button>
			*/
			?>
			<button id="btnReport" type="button" class="btn btn-secondary"><i class="fa fa-exclamation fa-2x"></i></button>
		</div>
    </div>
</div>

<?php
$blockContent = ob_get_clean();





//---------------//
// BLOCK JS //
//---------------//

ob_start();
?>
<script>
	
	var productId = '<?= $product['id'] ?>';

    var productRead = function () {
        var o = this;
        // o.xhr = null;
        o.init();
    };

	productRead.prototype = {
        init: function () {
            var o = this;
            o.handleEvents();
        },
        handleEvents: function () {
            var o = this;

            $('#btnLike').click(function(){
				var btn = $(this);
				
				var like = !$(this).hasClass("active") ? 1 : 0;

				$.ajax({
                    type: "POST",
                    url: "<?= $app->router()->getRoute('front_personality_product_read_like_ajax', [
						'id' => $personality['id'],
						'product' => $product['id']
					]) ?>",
                    data: {
						like: like
					},
                    dataType: 'JSON',
                    success: function (data) {
						if (data.user_authenticated == false){
							buildModal('myModal');

							$('#myModalLabel').html("Vous n'êtes pas connecté !");
							$('#myModal').find('.modal-body').html('Veuillez-vous <a href="' + frontLoginRoute + '">connecter</a> ou vous <a href="' + frontRegisterRoute + '">inscrire</a>.');
							$('#myModal').modal('show');
						} else {
							if (data.content == 'liked'){
								$(btn).addClass('active');
							} else {
								$(btn).removeClass('active');
							}
						}
					}
				});
			});
			$('#btnAddToWishList').click(function(){
				var btn = $(this);
			});
        }
    };
    new productRead();
</script>
<?php
$blockJs = ob_get_clean();





require __DIR__ . '/../../base.php';
