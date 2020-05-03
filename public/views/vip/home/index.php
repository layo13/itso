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
        <div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">

            <!--begin:: Widgets/Applications/User/Profile1-->
            <div class="kt-portlet kt-portlet--height-fluid-">
                <div class="kt-portlet__head  kt-portlet__head--noborder">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Mon profil
                        </h3>
                    </div>
                </div>
                <!-- INFOS PROFIL -->
                <div class="kt-portlet__body kt-portlet__body--fit-y">

                    <!--begin::Widget -->
                    <div class="kt-widget kt-widget--user-profile-1">
                        <div class="kt-widget__head">
                            <div class="kt-widget__media">
                                <img src="<?=$url?>public/assets/images/users/<?= $user['picture_name']?>" alt="image">
                            </div>
                            <div class="kt-widget__content">
                                <div class="kt-widget__section">
                                    <a href="#" class="kt-widget__username">
                                        <?= utf8_encode($user['first_name']." ". $user['last_name'])?>
                                        <i class="flaticon2-correct kt-font-success"></i>
                                    </a>
                                    <span class="kt-widget__subtitle">
										<?= $user['category_name']?>
									</span>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget__body">
                            <div class="kt-widget__content">
                                <div class="kt-widget__info">
                                    <span class="kt-widget__label">Email:</span>
                                    <a href="#" class="kt-widget__data"><?= $user['email']?></a>
                                </div>
                                <div class="kt-widget__info">
                                    <span class="kt-widget__label">Abonnés:</span>
                                    <a href="#" class="kt-widget__data"><?= $nbSubscriber['nb_subscriber']?></a>
                                </div>
                                <div class="kt-widget__info">
                                    <span class="kt-widget__label">Total de like sur vos produit:</span>
                                    <a href="#" class="kt-widget__data"><?= $nbTotalLike['nb_product_like']?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end::Widget -->
                </div>
            </div>
            <!--end:: Widgets/Applications/User/Profile1-->
            <!-- INFOS PRODUITS -->
            <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
                <div class="row">
                    <div class="col-xl-6">

                        <!--begin:: Widgets/Order Statistics-->
                        <div class="kt-portlet kt-portlet--height-fluid">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                       Statistiques du mois
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body kt-portlet__body--fluid">
                                <div class="kt-widget12">
                                    <div class="kt-widget12__content">
                                        <div class="kt-widget12__item">
                                            <div class="kt-widget12__info">
                                                <span class="kt-widget12__desc">Revenue</span>
                                                <span class="kt-widget12__value">4,000€</span>
                                            </div>
                                            <div class="kt-widget12__info">
                                                <span class="kt-widget12__desc">Clique total</span>
                                                <span class="kt-widget12__value">1.600</span>
                                            </div>
                                        </div>
                                        <div class="kt-widget12__item">
                                            <div class="kt-widget12__info">
                                                <span class="kt-widget12__desc">Revenue moyen</span>
                                                <span class="kt-widget12__value">2,000</span>
                                            </div>
                                            <div class="kt-widget12__info">
                                                <span class="kt-widget12__desc">Revenue Margin</span>
                                                <div class="kt-widget12__progress">
                                                    <div class="progress kt-progress--sm">
                                                        <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 50%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="kt-widget12__stat">
                                                        50%
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget12__chart" style="height:250px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                        <canvas id="kt_chart_order_statistics" style="display: block; width: 557px; height: 250px;" width="557" height="250" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end:: Widgets/Order Statistics-->
                    </div>
                    <div class="col-xl-6">

                        <!--begin:: Widgets/Tasks -->
                        <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        Mes produits
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="kt_widget2_tab1_content">
                                        <div class="kt-widget2">
                                            <div class="kt-widget2__item kt-widget2__item--primary">
                                                <div class="kt-widget2__checkbox">
                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="kt-widget2__info">
                                                    <a href="#" class="kt-widget2__title">
                                                        Nom du produit publié - Catégorie de produit
                                                    </a>
                                                    <a href="#" class="kt-widget2__username">
                                                        Nombre de clique sur les liens
                                                    </a>
                                                </div>
                                                <div class="kt-widget2__actions">
                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                        <i class="flaticon-more-1"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Statistique</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Modifier</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="kt_widget2_tab2_content">
                                        <div class="kt-widget2">
                                            <div class="kt-widget2__item kt-widget2__item--success">
                                                <div class="kt-widget2__checkbox">
                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="kt-widget2__info">
                                                    <a href="#" class="kt-widget2__title">
                                                        Make Metronic Development.Lorem Ipsum
                                                    </a>
                                                    <a class="kt-widget2__username">
                                                        By James
                                                    </a>
                                                </div>
                                                <div class="kt-widget2__actions">
                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                        <i class="flaticon-more-1"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget2__item kt-widget2__item--warning">
                                                <div class="kt-widget2__checkbox">
                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="kt-widget2__info">
                                                    <a href="#" class="kt-widget2__title">
                                                        Prepare Docs For Metting On Monday
                                                    </a>
                                                    <a href="#" class="kt-widget2__username">
                                                        By Sean
                                                    </a>
                                                </div>
                                                <div class="kt-widget2__actions">
                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                        <i class="flaticon-more-1"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget2__item kt-widget2__item--danger">
                                                <div class="kt-widget2__checkbox">
                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="kt-widget2__info">
                                                    <a href="#" class="kt-widget2__title">
                                                        Completa Financial Report For Emirates Airlines
                                                    </a>
                                                    <a href="#" class="kt-widget2__username">
                                                        By Bob
                                                    </a>
                                                </div>
                                                <div class="kt-widget2__actions">
                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                        <i class="flaticon-more-1"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget2__item kt-widget2__item--primary">
                                                <div class="kt-widget2__checkbox">
                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="kt-widget2__info">
                                                    <a href="#" class="kt-widget2__title">
                                                        Make Metronic Great Again.Lorem Ipsum Amet
                                                    </a>
                                                    <a href="#" class="kt-widget2__username">
                                                        By Bob
                                                    </a>
                                                </div>
                                                <div class="kt-widget2__actions">
                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                        <i class="flaticon-more-1"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget2__item kt-widget2__item--info">
                                                <div class="kt-widget2__checkbox">
                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="kt-widget2__info">
                                                    <a href="#" class="kt-widget2__title">
                                                        Completa Financial Report For Emirates Airlines
                                                    </a>
                                                    <a href="#" class="kt-widget2__username">
                                                        By Sean
                                                    </a>
                                                </div>
                                                <div class="kt-widget2__actions">
                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                        <i class="flaticon-more-1"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget2__item kt-widget2__item--brand">
                                                <div class="kt-widget2__checkbox">
                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="kt-widget2__info">
                                                    <a href="#" class="kt-widget2__title">
                                                        Make Widgets Development.Estudiat Communy Elit
                                                    </a>
                                                    <a href="#" class="kt-widget2__username">
                                                        By Aziko
                                                    </a>
                                                </div>
                                                <div class="kt-widget2__actions">
                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                        <i class="flaticon-more-1"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="kt_widget2_tab3_content">
                                        <div class="kt-widget2">
                                            <div class="kt-widget2__item kt-widget2__item--warning">
                                                <div class="kt-widget2__checkbox">
                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="kt-widget2__info">
                                                    <a href="#" class="kt-widget2__title">
                                                        Make Metronic Development. Lorem Ipsum
                                                    </a>
                                                    <a class="kt-widget2__username">
                                                        By James
                                                    </a>
                                                </div>
                                                <div class="kt-widget2__actions">
                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                        <i class="flaticon-more-1"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget2__item kt-widget2__item--danger">
                                                <div class="kt-widget2__checkbox">
                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="kt-widget2__info">
                                                    <a href="#" class="kt-widget2__title">
                                                        Completa Financial Report For Emirates Airlines
                                                    </a>
                                                    <a href="#" class="kt-widget2__username">
                                                        By Bob
                                                    </a>
                                                </div>
                                                <div class="kt-widget2__actions">
                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                        <i class="flaticon-more-1"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget2__item kt-widget2__item--brand">
                                                <div class="kt-widget2__checkbox">
                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="kt-widget2__info">
                                                    <a href="#" class="kt-widget2__title">
                                                        Make Widgets Development.Estudiat Communy Elit
                                                    </a>
                                                    <a href="#" class="kt-widget2__username">
                                                        By Aziko
                                                    </a>
                                                </div>
                                                <div class="kt-widget2__actions">
                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                        <i class="flaticon-more-1"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget2__item kt-widget2__item--info">
                                                <div class="kt-widget2__checkbox">
                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="kt-widget2__info">
                                                    <a href="#" class="kt-widget2__title">
                                                        Completa Financial Report For Emirates Airlines
                                                    </a>
                                                    <a href="#" class="kt-widget2__username">
                                                        By Sean
                                                    </a>
                                                </div>
                                                <div class="kt-widget2__actions">
                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                        <i class="flaticon-more-1"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget2__item kt-widget2__item--success">
                                                <div class="kt-widget2__checkbox">
                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="kt-widget2__info">
                                                    <a href="#" class="kt-widget2__title">
                                                        Completa Financial Report For Emirates Airlines
                                                    </a>
                                                    <a href="#" class="kt-widget2__username">
                                                        By Bob
                                                    </a>
                                                </div>
                                                <div class="kt-widget2__actions">
                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                        <i class="flaticon-more-1"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget2__item kt-widget2__item--primary">
                                                <div class="kt-widget2__checkbox">
                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="kt-widget2__info">
                                                    <a href="#" class="kt-widget2__title">
                                                        Make Metronic Great Again.Lorem Ipsum Amet
                                                    </a>
                                                    <a href="#" class="kt-widget2__username">
                                                        By Bob
                                                    </a>
                                                </div>
                                                <div class="kt-widget2__actions">
                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                                        <i class="flaticon-more-1"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end:: Widgets/Tasks -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">

                        <!--begin:: Widgets/Last Updates-->
                        <div class="kt-portlet kt-portlet--height-fluid">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        Derniers produits publiés
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body">

                                <!--begin::widget 12-->
                                <div class="kt-widget4">
                                    <div class="kt-widget4__item">
                                        <span class="kt-widget4__icon">
                                            <i class="flaticon-pie-chart-1 kt-font-info"></i>
                                        </span>
                                        <a href="#" class="kt-widget4__title kt-widget4__title--light">
                                            Nom du produit publié - Catégorie de produit
                                        </a>
                                        <span class="kt-widget4__number kt-font-info">27/04/2020</span>
                                    </div>
                                </div>

                                <!--end::Widget 12-->
                            </div>
                        </div>

                        <!--end:: Widgets/Last Updates-->
                    </div>
                    <div class="col-xl-6">

                        <!--begin:: Widgets/Notifications-->
                        <div class="kt-portlet kt-portlet--height-fluid">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        Notifications
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="kt_widget6_tab1_content" aria-expanded="true">
                                        <div class="kt-notification">
                                            <a href="#" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"></path>
                                                            <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) " x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        Vous avez 20 nouveaux abonnés aujourd'hui
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        Totals : 250
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end:: Widgets/Notifications-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End::Row-->

</div>
<!-- end:: Content -->


<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
