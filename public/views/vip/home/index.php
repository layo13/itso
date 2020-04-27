<?php

//---------------//
// BLOCK CONTENT //
//---------------//

ob_start();
?>

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">Tableau de bord</h3>
				<span class="kt-subheader__separator kt-hidden"></span>
			</div>
		</div>
	</div>

	<!-- end:: Subheader -->

	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!-- /// A FAIRE ///contenu de la page à définir -->
    </div>
    <!--End::Row-->

</div>
<!-- end:: Content -->


<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
