<?php

//---------------//
// BLOCK CONTENT //
//---------------//

ob_start();
?>

<table class="table table-bordered table-striped table-hover">
	<tr>
		<th>#</th>
		<th>Nom/Prénom</th>
		<th>E-mail</th>
	</tr>
	<tr>
		<td>1</td>
		<td>Lionel GUISSANI</td>
		<td>liodu13170@gmail.com</td>
	</tr>
	<tr>
		<td>2</td>
		<td>Thomas PICCI</td>
		<td>thomas.bruno.13@gmail.com</td>
	</tr>
</table>
<?php

$blockContent = ob_get_clean();
require __DIR__.'/layout.php';