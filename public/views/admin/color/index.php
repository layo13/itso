<?php
//---------------//
// BLOCK CONTENT //
//---------------//

ob_start();
?>

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

	<!-- begin:: Content Head -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Couleurs vêtements
				</h3>
			</div>
			<div class="kt-subheader__toolbar">
				<a href="#" class="">
				</a>
				<a href="<?= $app->router()->getRoute('admin_color_add') ?>" class="btn btn-label-brand btn-bold">
					Ajouter une couleur
                </a>
			</div>
		</div>
	</div>

	<!-- end:: Content Head -->

	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

		<?php foreach($colors as $color){ ?>
		
		<!--begin:: Portlet-->
		<div class="kt-portlet">
			<div class="kt-portlet__body">
				<div class="kt-widget kt-widget--user-profile-3">
					<div class="kt-widget__top">
						<div class="kt-widget__media kt-hidden-">
                            <i id="formProductColorDemo" class="fa fa-square-full" style="color: <?= $color['hex'];?>"></i>
						</div>
						<div class="kt-widget__content">
							<div class="kt-widget__head">
								<a href="#" class="kt-widget__username">
									<?= $color['name'] ?>
									<i class="flaticon2-correct kt-font-success"></i>
								</a>
								<div class="kt-widget__action">
									<a href="<?= $app->router()->getRoute('admin_color_update',$color['id']) ?>" class="btn btn-brand btn-sm">détail</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>

	<!-- end:: Content -->
</div>


<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
