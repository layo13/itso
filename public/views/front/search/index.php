<?php
//---------------//
// BLOCK CONTENT //
//---------------//

/* @var $app Epic\BaseApplication */
$app;

ob_start();
?>

<div class="row">
    <div class="col-12">
        <form>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
                <input type="text" class="form-control" id="search" name="search" placeholder="Selena Gomez, Ariana Grande ..." autofocus>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <ul id="search_results" class="list-unstyled"></ul>
    </div>
</div>

<?php
$blockContent = ob_get_clean();

//---------------//
// BLOCK JS //
//---------------//

ob_start();
?>
<script id="search_result_template" type="text/template">
	<div class="media">
	<img src="[[RESULT.PICTURE]]" class="mr-3" alt="[[RESULT.NAME]]" width="64" height="64">
	<div class="media-body">
	<a href="[[LINK]]">
	<h5 class="mt-0 mb-1">[[RESULT.NAME]]</h5>
	</a>
	<!-- Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus. --                       >
	</div>                           
	</div>
</script>
<script>
	
	var frontPersonalityReadRoute = '<?= $app->router()->getRoute('front_personality_read', ['id' => '[[ID]]']) ?>';
	var frontBrandReadRoute       = '<?= $app->router()->getRoute('front_brand_read', ['id' => '[[ID]]']) ?>';
	
    var search = function () {
        var o = this;
        o.xhr = null;
        o.init();
    };

    search.prototype = {
        init: function () {
            var o = this;
            o.handleEvents();
        },
        handleEvents: function () {
            var o = this;

            $('#search').on('input', function () {
                var query = $(this).val();
                if (query == '') {
                    return;
                }

                if (o.xhr != null) {
                    o.xhr = null;
                }

                xhr = $.ajax({
                    type: "POST",
                    url: "<?= $app->router()->getRoute('front_search_exec') ?>",
                    data: {query: query},
                    dataType: 'JSON',
                    success: function (data) {
                        $('#search_results').empty();
                        for (var result of data) {

                            if (result.picture != undefined && result.picture != null) {
                                if (result.type == 'user') {
                                    result.picture = URL + 'public/assets/images/user/' + result.picture;
									var link = frontPersonalityReadRoute.replace('[[ID]]', result.id);
                                } else if (result.type == 'brand') {
                                    result.picture = URL + 'public/assets/images/brand/' + result.picture;
									var link = frontBrandReadRoute.replace('[[ID]]', result.id);
                                } else {
                                    result.picture = null;
									var link = '#';
                                }
                            } else {
                                result.picture = null;
								var link = '#';
                            }

                            var template = $('#search_result_template').html(),
                                    view = template.replace('[[LINK]]', link)
                                    .replace('[[RESULT.NAME]]', result.name)
                                    .replace('[[RESULT.NAME]]', result.name);
                            if (result.picture == null) {
                                view = view.replace('[[RESULT.PICTURE]]', URL + 'public/assets/images/no-image-available.jpg');
                            } else {
                                view = view.replace('[[RESULT.PICTURE]]', result.picture);
                            }

                            $('#search_results').append(view);
                        }
                    }
                });
            });
        }
    };
    new search();
</script>
<?php
$blockJs = ob_get_clean();
require __DIR__ . '/../base.php';
