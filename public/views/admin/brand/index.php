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
			<div class="kt-subheader__toolbar">
				<a href="#" class="">
				</a>
				<a href="" class="btn btn-label-brand btn-bold">
					Ajouter une marque
                </a>
			</div>
		</div>
	</div>

	<!-- end:: Content Head -->

	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="row">
		<?php
        $i = 0;
        foreach($brands as $brand ){
                ?>
                <div class="col-xl-3">
                    <!--Begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__body">
                            <!--begin::Widget -->
                            <div class="kt-widget kt-widget--user-profile-4">
                                <div class="kt-widget__head">
                                    <div class="kt-widget__media">
                                        <img class="kt-widget__img kt-hidden-" src="<?=$url?>public/assets/images/brand/<?= $brand['brand_picture'] ?>" alt="image">
                                        <img class="kt-widget__img kt-hidden" src="<?=$url?>public/assets/images/brand/<?= $brand['brand_picture'] ?>" alt="image">
                                        <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-hidden">
                                            JB
                                        </div>
                                    </div>
                                    <div class="kt-widget__content">
                                        <div class="kt-widget__section">
                                            <a href="#" class="kt-widget__username">
                                                <?= $brand['name']?>
                                            </a>
                                            <div class="kt-widget__button">
                                                <span class="btn btn-label-warning btn-sm">Active</span>
                                            </div>
                                            <div class="kt-widget__action">
                                                <a href="/itso/brand/view,<?= $brand['id'] ?>" class="btn btn-label-brand btn-lg btn-upper">Plus de détail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Widget -->
                        </div>
                        <!--End::Portlet-->
                    </div>
                </div>
                <?php
            $i++;
		} ?>
        </div>
		
		<!--end:: Portlet-->

		<!--Begin::Pagination-->

		<!--End::Pagination-->

	<!-- end:: Content -->
</div>
</div>


<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
