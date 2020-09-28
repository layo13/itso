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
		<style type="text/css">
			html,
			body {
				/*height: 100%;*/
				background-color: #333;
			}
			body {
				color: #fff;
			}
            /*PAGE ACCUEIL PHOTO CARRE*/
            .img-cube-container {
                margin: 0 auto;
                margin-bottom: 25px;
                width: 200px;
                height: 200px;
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
			<div class=".navbar-nav">

				<?php if ($user->isAuthenticated()) { ?>
					<a class="nav-link" href="<?= $app->router()->getRoute('front_profile'); ?>"><i class="fa fa-cog"></i></a>
				<?php } else { ?>
					<a class="nav-link" href="<?= $app->router()->getRoute('front_login'); ?>"><i class="fa fa-user"></i></a>
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
				<a class="nav-link" href="<?= $app->router()->getRoute('front_home'); ?>">
					<i class="fa fa-2x fa-home"></i>
				</a>
			</div>
			<div class=".navbar-nav">
				<a class="nav-link" href="<?= $app->router()->getRoute('front_search'); ?>">
					<i class="fa fa-2x fa-search"></i>
				</a>
			</div>
			<div class=".navbar-nav">
				<a class="nav-link" href="#">
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

            var destroyModal = function (id) {
                if (id[0] != '#') {
                    id = '#' + id;
                }
				$(id).empty();
            };

            <?php /*$('#myModal').modal({
                keyboard: false
            });
            $('#myModal').modal('show');*/ ?>

		</script>
		<?= $blockJs ?>
	</body>
</html>
