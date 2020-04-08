<?php
//------------//
// BLOCK BODY //
//------------//

ob_start();
?>

<?php
include __DIR__ . '/navbar.php';
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?= $blockContent ?>
		</div>
	</div>
</div>




<?php
$blockBody = ob_get_clean();
require __DIR__ . '/base.php';
