<?php
//---------------//
// BLOCK CONTENT //
//---------------//

/** @var Epic\BaseApplication $app */
$app;

ob_start();
?>

<?php //require __DIR__.'/../heading.php'; ?>


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
        <?php
			// var_dump($personality, $product);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-6">		
		<img title="<?= $product['pictures'][0]['name'] ?>" class="img-fluid" src="<?= $url ?>public/assets/images/product/<?= $product['pictures'][0]['name'] ?>" alt="<?= $product['name'] ?>" />
        <div class="product_desc"><?= $product['name'] ?></div>
    </div>
    <div class="col-3">
        
		<?php foreach($product['pictures'] as $picture){ ?>
			<div class="row">
				<div class="col-12">
					<img title="<?= $product['name'] ?>" class="img-fluid" src="<?= $url ?>public/assets/images/product/<?= $picture['name'] ?>" alt="<?= $product['name'] ?>" />
				</div>
			</div>
		<?php } ?>
		
    </div>
    <div class="col-3">
        <div class="btn-group-vertical" role="group" aria-label="Basic example">
			<?php // LIKE ?>
			<button title="Liker" id="btnLike" type="button" class="btn btn-secondary <?= $likeClass ?>"><i class="fa fa-heart fa-2x"></i></button>
			<?php // AJOUTER A UNE PLAYLIST ?>
			<button title="Ajouter à ma wishlist" id="btnAddToWishList" type="button" class="btn btn-secondary"><i class="fa fa-plus fa-2x"></i></button>
			<?php // ACHETER ?>
			<button title="Accéder à la boutique" id="btnBuy" type="button" class="btn btn-secondary"><i class="fa fa-shopping-cart fa-2x"></i></button>
			<?php
			/*
			<!-- C'est juste pour garder les identifiants des icons font awesome -->
			<button type="button" class="btn btn-secondary"><i class="fa fa-person-booth fa-2x"></i></button>
			<button type="button" class="btn btn-secondary"><i class="fa fa-map-marked-alt fa-2x"></i></button>
			*/
			?>
			<button title="Signaler un problème" id="btnReport" type="button" class="btn btn-secondary"><i class="fa fa-exclamation fa-2x"></i></button>
		</div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <a href="" class="btn_article_similaire">Articles similaires</a>
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
        o.init();
    };

	productRead.prototype = {
        init: function () {
            var o = this;
            o.handleEvents();
        },
		handleCheckboxAddToWishlist: function (el) {
            var o = this;
			$.ajax({
				type: "POST",
				url: "<?= $app->router()->getRoute('front_wishlist_add_product') ?>",
				data: {
					wishlist: $(el).val(),
					product: productId,
					operation: $(el).is(':checked') ? 'add' : 'remove'
				},
				dataType: 'JSON',
				success: function (data) {
					if (data.user_authenticated == false){
						destroyModal('myModal');
						buildConnectOrRegisterModal('myModal');
					} else {
						
					}
				}
			});
			
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
							buildConnectOrRegisterModal('myModal');
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
				
				$.ajax({
                    type: "POST",
                    url: "<?= $app->router()->getRoute('front_personality_product_read_add_to_wishlist_ajax', [
						'id' => $personality['id'],
						'product' => $product['id']
					]) ?>",
                    data: {},
                    dataType: 'JSON',
                    success: function (data) {
						if (data.user_authenticated == false){
							buildConnectOrRegisterModal('myModal');
						} else {
							
							var modalBody = $('#readProductModalBody').html();
							
							buildModal('myModal');
							$('#myModalLabel').html("Ajouter à une wishlist");
							$('#myModal').find('.modal-body').html(render(modalBody, {
								wishlists: data.content
							}));
							
							$('#addToWishlist').find('.form-check-input')
								.unbind()
								.change(function(e){
									o.handleCheckboxAddToWishlist(e.target);
								});
								
							$('#addWishlist').submit(function(e){
								e.preventDefault();
								
								
								$.ajax({
									type: "POST",
									url: "<?= $app->router()->getRoute('front_wishlist_add') ?>",
									data: {
										name: $('#wishlist_name').val()
									},
									dataType: 'JSON',
									success: function (data) {
										if (data.user_authenticated == false){
											destroyModal('myModal')
											buildConnectOrRegisterModal('myModal');
										} else {
											console.log(data);
											
											var html = `<div class="form-check">
			<input class="form-check-input" type="checkbox" value="${data.wishlist.id}" id="defaultCheck${data.wishlist.id}">
			<label class="form-check-label" for="defaultCheck${data.wishlist.id}">
			  ${data.wishlist.name}
			</label>
		</div>`;
											$('#addToWishlist').append(html);
											$('#addWishlist').trigger("reset");
											
											$('#addToWishlist').find('.form-check-input')
													.unbind()
													.change(function(e){
														o.handleCheckboxAddToWishlist(e.target);
													});
										}
									}
								});
							});
						
							$('#myModal').modal('show');
						}
					}
				});
			});
			$('#btnBuy').click(function(){
				var btn = $(this);

				$.ajax({
                    type: "POST",
                    url: "<?= $app->router()->getRoute('front_personality_product_get_links_ajax', [
						'id' => $personality['id'],
						'product' => $product['id']
					]) ?>",
                    data: {},
                    dataType: 'JSON',
                    success: function (data) {
						
						var modalBody = '';
						for (var productLink of data.content) {
							modalBody += '<p>Acheter sur <a target="_blank" href="' + productLink.url + '">' + productLink.host + '</a></p>';
						}
						
						buildModal('myModal');
						$('#myModalLabel').html("Acheter ce produit");
						$('#myModal').find('.modal-body').html(modalBody);
						$('#myModal').modal('show');
					}
				});
			});
        }
    };
    new productRead();
</script>
<script id="readProductModalBody" type="text/template">
	<form id="addToWishlist">
		{% for(wishlist of wishlists){ %}
		<div class="form-check">
			<input class="form-check-input" type="checkbox" value="{{ wishlist.id }}" id="defaultCheck{{ wishlist.id }}" {% if(wishlist.in) { %} checked="checked"{% } %} >
			<label class="form-check-label" for="defaultCheck{{ wishlist.id }}">
			  {{ wishlist.name }}
			</label>
		</div>
		{% } %}
	</form>
	<br />
	<form id="addWishlist">
		<div class="row">
			<div class="col-md-9 col-sm-9 col-xs-9">
				<div class="form-group">
					<input id="wishlist_name" name="wishlist_name" type="text" class="form-control" placeholder="Créer une wishlist" required="required" />
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-3">
				<button type="submit" class="btn btn-success-gr">
					Créer
				</button>
			</div>
		</div>
	</form>
</script>
<?php
$blockJs = ob_get_clean();





require __DIR__ . '/../../base.php';
