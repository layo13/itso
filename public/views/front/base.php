<?php
/* @var $app Epic\BaseApplication */
$app;

/* @var $user \Epic\User */
$user;

$blockJs = isset($blockJs) ? $blockJs : '';
?><!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="<?= $url ?>public/assets/fontawesome/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Anton&family=Sansita+Swashed:wght@500&display=swap" rel="stylesheet">

        <style type="text/css">
            html,
            body {
                /*height: 100%;*/
                background-color: #121212;
            }
            body {
                color: #b3b3b3;
            }
            /*PAGE DETAIL */
            a.btn_article_similaire {
                background: #fff;
                padding: 10px 20px;
                color: #000;
                text-decoration: none;
                border-radius: 50px;
                font-size: 18px;
                font-weight: 500;
            }

            /*PAGE ACCUEIL */
            .card-body h5 {
                font-size: 32px;
                font-family: 'Sansita Swashed', cursive;
            }

            .text-right.mb-0 a {
                font-size: 25px!important;
                color: #24cf5f;
                font-weight: 600;
            }

            p.text-center.tt_dons {
                font-size: 28px;
                font-family: 'Sansita Swashed', cursive;
            }

            p.text-center.tt_dons i.fa {
                color: red;
                margin-right: 10px;
            }
            /*PAGE ACCUEIL PHOTO CARRE*/
            .img-cube-container {
                margin: 0 auto;
                margin-left: 0;
                margin-bottom: 5px;
                width: 255px;
                height: 255px;
            }
            .product_desc, .sub_desc {
                position: relative;
                display: block;
                color: #fff;
                margin-bottom: 50px;
                max-width: 250px;
            }
            .sub_desc{
                text-align: center;
                font-size: 18px;
                font-weight: 500;
            }
            /*PAGE SEARCH LISTE RECHERCHE GENERE*/
            .media-body a h5 {
                color: #fff;
                margin-top: 13px;
                position: relative;
                display: block;
            }

            .media-body {
                padding-top: 17px;
            }

            ul#search_results {
                padding-left: 42px;
                margin-top: 3px;
            }

            /* MODAL */
            .modal{
                color: #212529;
            }

            /*PAGE PROFIL PERSONNALITY*/
            img.rounded-circle.mx-auto.d-block.profile_read_first {
                max-width: 127px;
                max-height: 128px;
            }
            nav.navbar.fixed-bottom.navbar-dark.bg-dark a {
                color: #fff;
            }

            nav.navbar.fixed-bottom.navbar-dark.bg-dark {
                background: #282828!important;
                border-top: 1px solid #000;
            }

            .navbar-nav a {
                color: #fff!important;
            }
            .bg-dark {
                background-color: #000!important;
            }
            .title_rubrique {
                color: #fff;
                border-bottom: 1px solid #b3b3b3;
                padding-bottom: 10px;
                margin-bottom: 20px;
                font-family: 'Anton', sans-serif;
            }
            button#btnSubscribe {
                background: transparent;
                border-radius: 20px;
                padding: 5px 40px;
            }
            button#btnSubscribe:hover {
                background: transparent;
                border-radius: 20px;
                padding: 5px 40px;
            }
            button#btnSubscribe.active{
                background: #24cf5f;
                border: 0;
            }
            h2.title_artist {
                font-size: 52px;
                color: #fff;
                margin-bottom: 40px;
                font-family: 'Anton', sans-serif;
            }
            span.nb_abonnee {
                position: relative;
                display: block;
                margin-bottom: 16px;
                padding-left: 0px;
            }
            hr {
                border-top: 1px solid rgb(18 18 18);
            }
            .rounded-circle.img-cube-container {
                width: 200px;
                height: 200px;
            }
            .rounded-circle.img-cube-container.profil_acc {
                width: 150px;
                height: 150px;
            }

            a.nav-link.close {
                display: inline-block;
            }
            /**
            MODAL
             */
            .modal-header,.modal-footer {
                border-top-left-radius: 0px!important;
                border-top-right-radius: 0px!important;
                border: 0px;
            }

            .modal-content {
                border-radius: 0px;
                background: #444;
                box-shadow: #000 0px 0px 10px 2px
            }

            div#myModal {
                color: #b3b3b3;
            }

            button.close {
                color: #fff;
            }

            h5#myModalLabel {
                color: #fff!important;
                text-align: center;
                width: 100%;
            }
            .modal-body a {
                color: #24cf5f;
            }

            .modal-backdrop.fade.show {
                background-color: transparent;
            }
            form#addToWishlist .form-check {
                position: relative;
                display: inline-block;
                padding: 4px 10px;
            }

            form#addToWishlist .form-check .form-check-input {
                position: relative;
                display: inline-block;
                margin-left: 0;
            }
            button.btn.btn-success-gr {
                background: #24cf5f;
                color: #fff;
                width: 100%;
            }
            .form-control{
                border-radius:0px
            }



            .input-group-text {
                border-radius: 50px;
                background: #fff;
                border: 0;
            }
            input#search {
                border: 0;
                border-radius: 0 50px 50px 0;
            }



            label.form-check-label {
                font-size: 26px;
                margin-left: 5px;
            }




            button#btnLike, button#btnAddToWishList, button#btnBuy,button#btnReport {
                margin-bottom: 20px!important;
                border-radius: 0px!important;
                border-color: #6c757d;
                width: 50px!important;
                height: 50px!important;
                color: #b3b3b3;
                padding-top: 8px;
                padding-left: 12px;
                background: transparent;
            }
            button#btnBuy {
                padding-left: 9px;
            }

            .card.bg-light.text-dark.mb-lg-5 {
                border-radius: 50px;
                padding-left: 25px;
                padding-right: 25px;
            }
		</style>
		<title>In The Shoes Of</title>
	</head>
	<body>
		<nav class="navbar sticky-top navbar-dark bg-dark">
			<form class="form-inline my-2 my-lg-0">
				<div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input" id="customSwitch1">
					<label class="custom-control-label" for="customSwitch1"><i class="fa fa-mars"></i></label>
				</div>
			</form>
			<ul class="nav navbar-nav navbar-logo mx-auto">
				<li class="nav-item">
					<a class="navbar-brand" href="<?= $app->router()->getRoute('front_home'); ?>">ITSO</a>
				</li>
			</ul>
			<div class="navbar-nav">

				<?php if ($user->isAuthenticated()) { ?>
					<a title="Mon profil" class="nav-link" href="<?= $app->router()->getRoute('front_profile'); ?>"><i class="fa fa-cog"></i></a>
				<?php } else { ?>
					<a title="Se connecter" class="nav-link" href="<?= $app->router()->getRoute('front_login'); ?>"><i class="fa fa-user"></i></a>
				<?php } ?>

			</div>
		</nav>
		<div class="container">
            <br />
			<?= $blockContent ?>
            <br />
            <br />
            <br />
            <br />
		</div>

		<?php /*
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
			Launch demo modal
		</button>
		 */ ?>

		<nav class="navbar fixed-bottom navbar-dark bg-dark">
			<div class=".navbar-nav">
				<a title="Accueil" class="nav-link" href="<?= $app->router()->getRoute('front_home'); ?>">
					<i class="fa fa-2x fa-home"></i>
				</a>
			</div>
			<div class=".navbar-nav">
				<a title="Rechercher" class="nav-link" href="<?= $app->router()->getRoute('front_search'); ?>">
					<i class="fa fa-2x fa-search"></i>
				</a>
			</div>
			<div class=".navbar-nav">
				<a title="Mes likes" class="nav-link close" href="<?= $app->router()->getRoute('front_like'); ?>">
					<i class="fa fa-2x fa-heart"></i>
				</a>
				<a title="Ma penderie" class="nav-link close" href="<?= $app->router()->getRoute('front_penderie'); ?>">
					<i class="fa fa-2x fa-tshirt"></i>
				</a>
			</div>
		</nav>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
			<?php /* <div class="modal-dialog">
			  <div class="modal-content">
			  <div class="modal-header">
			  <h5 class="modal-title" id="myModalLabel">Modal title</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			  </button>
			  </div>
			  <div class="modal-body">
			  ...
			  </div>
			  <div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  <button type="button" class="btn btn-primary">Save changes</button>
			  </div>
			  </div>
			  </div> */ ?>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script type="text/javascript">
            const URL = '<?= URL ?>';
			
			var frontLoginRoute = '<?= $app->router()->getRoute('front_login') ?>';
			var frontRegisterRoute = '<?= $app->router()->getRoute('front_register') ?>';
			
            var render = function (template, values) {

                template = template.split("\n")
                        .join("\\\n")
                        .replace(/"/g, '\\"');

                var code = 'var content = "' + template + '"';

                if (values != undefined) {
                    for (var key in values) {
                        this[key] = values[key];
                    }
                }

                while (code.indexOf('{%') > -1) {
                    code = code.replace('{%', '";');
                }
                while (code.indexOf('%}') > -1) {
                    code = code.replace('%}', 'content += "');
                }
                while (code.indexOf('{{') > -1) {
                    code = code.replace('{{', '";content += ');
                }
                while (code.indexOf('}}') > -1) {
                    code = code.replace('}}', ';content += "');
                }
                eval(code);
                return content;
            };

            var buildModal = function (id) {
                if (id[0] != '#') {
                    id = '#' + id;
                }
				var $modal = $(id);

                var $modalDialog = $('<div></div>', {"class": "modal-dialog"});
                var $modalContent = $('<div></div>', {"class": "modal-content"});
                var $modalHeader = $('<div></div>', {"class": "modal-header"});
                var $modalTitle = $('<h5></h5>', {"class": "modal-title", "id": "myModalLabel", "text": "Modal title"});
                var $iconClose = $('<button></button>', {"type": "button", "class": "close", "data-dismiss": "modal", "aria-label": "Close"});
                var $icon = $('<span></span>', {"aria-hidden": "true", "html": "&times;"});
				var $modalBody = $('<div></div>', {"class": "modal-body"});
				var $modalFooter = $('<div></div>', {"class": "modal-footer"});
				var $buttonClose = $('<button></button>', {"type": "button", "class": "btn btn-secondary", "data-dismiss": "modal", "text": "Fermer"});

                $($iconClose).append($icon);
				$($modalHeader).append($modalTitle);            
				$($modalHeader).append($iconClose);
				$($modalContent).append($modalHeader);
				$($modalContent).append($modalBody);
				$($modalFooter).append($buttonClose);
				$($modalContent).append($modalFooter);
				$($modalDialog).append($modalContent);
				$($modal).append($modalDialog);
            };
			
			$('#myModal').on('hidden.bs.modal', function (e) {
				$(this).empty();
			});

            var destroyModal = function(id) {
                if (id[0] != '#') {
                    id = '#' + id;
                }
				$(id).empty();
            };
			
			var buildConnectOrRegisterModal = function(id) {
				buildModal(id);
				$('#myModalLabel').html("Vous n'êtes pas connecté !");
				$('#myModal').find('.modal-body').html('Veuillez-vous <a href="' + frontLoginRoute + '">connecter</a> ou vous <a href="' + frontRegisterRoute + '">inscrire</a>.');
				$('#myModal').modal('show');
			}

            <?php /*$('#myModal').modal({
                keyboard: false
            });
            $('#myModal').modal('show');*/ ?>

		</script>
		<?= $blockJs ?>
	</body>
</html>
