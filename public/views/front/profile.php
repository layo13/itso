<?php
//---------------//
// BLOCK CONTENT //
//---------------//

/* @var $app Epic\BaseApplication */
$app;
/** @var Epic\User $user */
$user;

ob_start();
?>

<span class="text-muted">Nom de famille</span>: <span class="text-info"><?= $user->getAttribute('last_name') ?></span>
<br />
<span class="text-muted">Prénom</span>: <span class="text-info"><?= $user->getAttribute('first_name') ?></span>
<br />
<a class="btn btn-danger" href="<?= $app->router()->getRoute('front_logout') ?>">Déconnexion</a>

<?php
$blockContent = ob_get_clean();
require __DIR__ . '/base.php';
