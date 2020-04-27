<?php
//---------------//
// BLOCK CONTENT //
//---------------//

ob_start();
?>

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Liste des marques
                </h3>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="" class="btn btn-default btn-bold">
                    Demande d'ajout d'une marque
                </a>
            </div>
        </div>
    </div>
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
                                    </div>
                                    <div class="kt-widget__content">
                                        <div class="kt-widget__section">
                                            <a href="" class="kt-widget__username">
                                                <?= $brand['name']?>
                                            </a>
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

	<!-- end:: Content -->
</div>
</div>


<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
