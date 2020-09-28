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
			<div class="col-md-10 col-sm-10 col-xs-10">
				<div class="form-group">
					<input id="wishlist_name" name="wishlist_name" type="text" class="form-control" placeholder="Créer une wishlist" required="required" />
				</div>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-2">
				<button type="submit" class="btn btn-success">
					Créer
				</button>
			</div>
		</div>
	</form>
</script>
<?php
$blockJs = ob_get_clean();





require __DIR__ . '/../../base.php';
