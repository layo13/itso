<?php
/* @var $app Epic\BaseApplication */
$app;

/* @var $user \Epic\User */
$user;

$blockJs = isset($blockJs) ?$blockJs: '';

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
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script type="text/javascript">
			const URL = '<?= URL ?>';
            var render = function (template, values) {

                template = template.split("\n")
								   .join("\\\n")
								   .replace(/"/g, '\\"');;
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
            }
		</script>
		<?= $blockJs ?>
	</body>
</html>
