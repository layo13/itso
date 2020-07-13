<?php
//---------------//
// BLOCK CONTENT //
//---------------//

/* @var $app Epic\BaseApplication */
$app;

ob_start();
?>

<a class="btn btn-danger" href="<?= $app->router()->getRoute('front_logout') ?>">Déconnexion</a>

<?php
$blockContent = ob_get_clean();
require __DIR__ . '/base.php';
