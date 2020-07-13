<?php
//---------------//
// BLOCK CONTENT //
//---------------//

ob_start();
?>

<form method="POST" action="<?= $app->router()->getRoute('front_login_exec') ?>">
	<div class="form-group">
		<label for="email">Adresse mail</label>
		<input type="email" class="form-control" id="email" aria-describedby="emailHelp">
		<?php /*<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>*/ ?>
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" id="password">
	</div>
	<?php /*
	<div class="form-group form-check">
		<input type="checkbox" class="form-check-input" id="exampleCheck1">
		<label class="form-check-label" for="exampleCheck1">Check me out</label>
	</div> */ ?>
	<button type="submit" class="btn btn-primary">Connexion</button>
</form>

<hr />

<p>Pas encore de compte ? <a href="<?= $app->router()->getRoute('front_register'); ?>">Inscrivez-vous ici !</a></p>

<?php
$blockContent = ob_get_clean();
require __DIR__ . '/base.php';
