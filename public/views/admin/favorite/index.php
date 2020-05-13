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
                        Categorie favorie
                    </h3>
                    <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                    <div class="kt-subheader__group" id="kt_subheader_search">
					<span class="kt-subheader__desc" id="kt_subheader_total">
                        <?php
                        if (!empty($user_favorite_category)){
                        ?>
                        <?= count($user_favorite_category) ?> Total </span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="kt-subheader__group kt-hidden" id="kt_subheader_group_actions">
                        <div class="kt-subheader__desc"><span id="kt_subheader_group_selected_rows"></span> Selected:
                        </div>
                        <div class="btn-toolbar kt-margin-l-20">
                            <div class="dropdown" id="kt_subheader_group_actions_status_change">
                                <button type="button" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle"
                                        data-toggle="dropdown">
                                    Update Status
                                </button>
                                <div class="dropdown-menu">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">Change status to:</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link" data-toggle="status-change"
                                               data-status="1">
                                                <span class="kt-nav__link-text"><span
                                                            class="kt-badge kt-badge--unified-success kt-badge--inline kt-badge--bold">Approved</span></span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link" data-toggle="status-change"
                                               data-status="2">
                                                <span class="kt-nav__link-text"><span
                                                            class="kt-badge kt-badge--unified-danger kt-badge--inline kt-badge--bold">Rejected</span></span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link" data-toggle="status-change"
                                               data-status="3">
                                                <span class="kt-nav__link-text"><span
                                                            class="kt-badge kt-badge--unified-warning kt-badge--inline kt-badge--bold">Pending</span></span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link" data-toggle="status-change"
                                               data-status="4">
                                                <span class="kt-nav__link-text"><span
                                                            class="kt-badge kt-badge--unified-info kt-badge--inline kt-badge--bold">On Hold</span></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <button class="btn btn-label-success btn-bold btn-sm btn-icon-h"
                                    id="kt_subheader_group_actions_fetch" data-toggle="modal"
                                    data-target="#kt_datatable_records_fetch_modal">
                                Fetch Selected
                            </button>
                            <button class="btn btn-label-danger btn-bold btn-sm btn-icon-h"
                                    id="kt_subheader_group_actions_delete_all">
                                Delete All
                            </button>
                        </div>
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <a href="#" class="">
                    </a>
                    <a href="<?= $app->router()->getRoute('admin_favorite_create') ?>" class="btn btn-success btn-bold">
                        Ajouter une categorie favorie
                    </a>
                </div>
            </div>
        </div>

        <!-- end:: Content Head -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

            <div class="row">
                <?php
                if (!empty($user_favorite_category)) {
                    ?>
                    <?php
                    foreach ($user_favorite_category as $favoriteByUser) {
                        ?>
                        <div class="col-sm-3">
                            <!--begin::List Widget 14-->
                            <div class="card card-custom card-stretch gutter-b">
                                <!--begin::Header-->
                                <div class="card-header border-0">
                                    <h3 class="card-title font-weight-bolder text-dark"><?= $favoriteByUser[0]['first_name'] ?> <?= $favoriteByUser[0]['last_name'] ?></h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-2">
                                <?php
                                foreach ($favoriteByUser as $favorite) {
                                    ?>
                                    <div class="d-flex flex-wrap align-items-center mb-10">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                                                    <div class="symbol-label"></div>
                                                </div>
                                                <!--end::Symbol-->

                                                <!--begin::Title-->
                                                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                                    <a href="<?= $app->router()->getRoute('admin_favorite_view', ['id' => $favorite['id']]) ?>" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">
                                                        <?= ucfirst($favorite['name']) ?>
                                                    </a>
                                                    <span class="text-muted font-weight-bold font-size-sm my-1">
                                                         <?php
                                                         if ($favorite['active'] == 1) {
                                                             ?>
                                                             Actif
                                                             <?php
                                                         } else {
                                                             ?>
                                                             Inactif
                                                             <?php
                                                         }
                                                         ?>
                                                    </span>
                                                </div>
                                                <!--end::Title-->

                                                <!--begin::Info
                                                <div class="d-flex align-items-center py-lg-0 py-2">
                                                    <div class="d-flex flex-column text-right">
                                                        <span class="text-dark-75 font-weight-bolder font-size-h4">
                                                            24,900
                                                        </span>
                                                        <span class="text-muted font-size-sm font-weight-bolder">
                                                            votes
                                                        </span>
                                                    </div>
                                                </div>
                                                -->
                                            </div>
                                <?php } ?>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::List Widget 14-->
                        </div>
                    <?php } ?>
                <?php } ?>

                <!--end:: Portlet-->
            </div>
        </div>

        <!-- end:: Content -->
    </div>


<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
