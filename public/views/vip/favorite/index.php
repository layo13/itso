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
                    <a href="<?= $app->router()->getRoute('vip_favorite_create') ?>" class="btn btn-success btn-bold">
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
                    foreach ($user_favorite_category as $favorite) {
                        ?>
                        <div class="col-xl-3">
                            <!--Begin::Portlet-->
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__body">
                                    <!--begin::Widget -->
                                    <div class="kt-widget kt-widget--user-profile-4">
                                        <div class="kt-widget__head">
                                            <div class="kt-widget__media">
                                            </div>
                                            <div class="kt-widget__content">
                                                <div class="kt-widget__section">
                                                    <div class="kt-widget__button">
                                                        <span class="btn btn-label-facebook btn-lg"><?= ucfirst($favorite['name']) ?></span>
                                                    </div>
                                                    <div class="kt-widget__button">
                                                        <?php
                                                        if ($favorite['active'] == 1) {
                                                            ?>
                                                            <span class="btn btn-label-success btn-md">Actif</span>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <span class="btn btn-danger btn-md">Inactif</span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="kt-widget__action">
                                                        <a href="<?= $app->router()->getRoute('vip_favorite_view', ['id' => $favorite['id']]) ?>"
                                                           class="btn btn-dark btn-sm btn-upper">Détail</a>
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
