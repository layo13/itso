<?php
/* @var $app Epic\BaseApplication */
$app;

?>
<!DOCTYPE html>
<html lang="fr">
    <?php require_once 'head.php'; ?>
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="<?= $app->router()->getRoute('admin_home') ?>">
					<img alt="Logo" src="<?=$url?>public/assets/images/logo.png" />
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>
		<!-- end:: Header Mobile -->

        <div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<!-- begin:: Aside -->
				<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
				<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

                    <!-- begin:: Aside -->
                    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand" kt-hidden-height="65" style="">
                        <div class="kt-aside__brand-logo">
                            <a href="<?= $app->router()->getRoute('admin_home') ?>">
                                <img alt="Logo" src="<?=$url?>public/assets/images/logo.png">
                            </a>
                        </div>
                        <div class="kt-aside__brand-tools">
                            <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--active" id="kt_aside_toggler"><span></span></button>
                        </div>
                    </div>
					<!-- end:: Aside -->

					<!-- begin:: Aside Menu -->

					<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
						<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
							<ul class="kt-menu__nav ">
								<li class="kt-menu__item<?= selectNavRubrique(['home'], $app->routeName(), 1)?>" aria-haspopup="true">
                                    <a href="<?= $app->router()->getRoute('admin_home') ?>" class="kt-menu__link ">
                                        <i class="kt-menu__link-icon flaticon2-architecture-and-city"></i>
                                        <span class="kt-menu__link-text">Accueil</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item kt-menu__item--submenu<?= selectNavRubrique(['user','vip','customer'], $app->routeName(), 1)?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                        <i class="kt-menu__link-icon flaticon2-user"></i>
                                        <span class="kt-menu__link-text">Utilisateurs</span>
                                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="kt-menu__submenu " style=""><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item kt-menu__item--submenu<?= selectNavRubrique(['vip','user'], $app->routeName(), 1)?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                                    <i class="kt-menu__link-icon fa fa-star"></i>
                                                    <span class="kt-menu__link-text">VIP</span>
                                                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                                </a>
                                                <div class="kt-menu__submenu<?= selectNavRubrique(['vip','user'], $app->routeName(), 1)?>">
                                                    <span class="kt-menu__arrow"></span>
                                                    <ul class="kt-menu__subnav<?= selectNavRubrique(['vip','user'], $app->routeName(), 1)?>">
                                                        <li class="kt-menu__item<?= selectNavRubrique(['list'], $app->routeName(), 2, ['vip','user'])?>" aria-haspopup="true">
                                                            <a href="<?= $app->router()->getRoute('admin_vip_list') ?>" class="kt-menu__link ">
                                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="kt-menu__link-text">Liste</span>
                                                            </a>
                                                        </li>
                                                        <li class="kt-menu__item <?= selectNavRubrique(['create'], $app->routeName(), 2, ['vip','user'])?>" aria-haspopup="true">
                                                            <a href="<?= $app->router()->getRoute('admin_vip_create') ?>" class="kt-menu__link ">
                                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="kt-menu__link-text">Ajouter</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="kt-menu__item kt-menu__item--submenu<?= selectNavRubrique(['customer'], $app->routeName(), 1)?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                                    <i class="kt-menu__link-icon fa fa-user-tie"></i>
                                                    <span class="kt-menu__link-text">Client</span>
                                                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                                </a>
                                                <div class="kt-menu__submenu ">
                                                    <span class="kt-menu__arrow"></span>
                                                    <ul class="kt-menu__subnav">
                                                        <li class="kt-menu__item <?= selectNavRubrique(['list'], $app->routeName(), 2, ['customer'])?>" aria-haspopup="true">
                                                            <a href="<?= $app->router()->getRoute('admin_customer_list') ?>" class="kt-menu__link ">
                                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="kt-menu__link-text">Liste</span>
                                                            </a>
                                                        </li>
                                                        <li class="kt-menu__item <?= selectNavRubrique(['create'], $app->routeName(), 2, ['customer'])?>" aria-haspopup="true">
                                                            <a href="<?= $app->router()->getRoute('admin_customer_create') ?>" class="kt-menu__link ">
                                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="kt-menu__link-text">Ajouter</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                                <li class="kt-menu__item kt-menu__item--submenu<?= selectNavRubrique(['brand'], $app->routeName(), 1)?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                        <i class="kt-menu__link-icon flaticon-business"></i>
                                        <span class="kt-menu__link-text">Marques</span>
                                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="kt-menu__submenu " style=""><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item<?= selectNavRubrique(['list'], $app->routeName(), 2, ['brand'])?>" aria-haspopup="true">
                                                <a href="<?= $app->router()->getRoute('admin_brand_list') ?>" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="kt-menu__link-text">Liste</span>
                                                </a>
                                            </li>
                                            <li class="kt-menu__item<?= selectNavRubrique(['create'], $app->routeName(), 2, ['brand'])?>" aria-haspopup="true">
                                                <a href="<?= $app->router()->getRoute('admin_brand_create') ?>" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="kt-menu__link-text">Ajouter</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="kt-menu__item kt-menu__item--submenu<?= selectNavRubrique(['charity'], $app->routeName(), 1)?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                        <i class="kt-menu__link-icon flaticon-black"></i>
                                        <span class="kt-menu__link-text">Associations</span>
                                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="kt-menu__submenu " style=""><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item <?= selectNavRubrique(['list'], $app->routeName(), 2, ['charity'])?>" aria-haspopup="true">
                                                <a href="<?= $app->router()->getRoute('admin_charity_list') ?>" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="kt-menu__link-text">Liste</span>
                                                </a>
                                            </li>
                                            <li class="kt-menu__item <?= selectNavRubrique(['create'], $app->routeName(), 2, ['charity'])?>" aria-haspopup="true">
                                                <a href="<?= $app->router()->getRoute('admin_charity_create') ?>" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="kt-menu__link-text">Ajouter</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="kt-menu__item kt-menu__item--submenu<?= selectNavRubrique(['product'], $app->routeName(), 1)?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                        <i class="kt-menu__link-icon flaticon2-box-1"></i>
                                        <span class="kt-menu__link-text">Produit</span>
                                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="kt-menu__submenu " style=""><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item <?= selectNavRubrique(['list'], $app->routeName(), 2, ['product'])?>" aria-haspopup="true">
                                                <a href="<?= $app->router()->getRoute('admin_product_list') ?>" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="kt-menu__link-text">Liste</span>
                                                </a>
                                            </li>
                                            <li class="kt-menu__item <?= selectNavRubrique(['create'], $app->routeName(), 2, ['product'])?>" aria-haspopup="true">
                                                <a href="<?= $app->router()->getRoute('admin_product_create') ?>" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="kt-menu__link-text">Ajouter</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                <li class="kt-menu__item kt-menu__item--submenu<?= selectNavRubrique(['selection'], $app->routeName(), 1)?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                        <i class="kt-menu__link-icon fa fa-user-check"></i>
                                        <span class="kt-menu__link-text">Sélections</span>
                                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="kt-menu__submenu " style=""><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item <?= selectNavRubrique(['list'], $app->routeName(), 2, ['selection'])?>" aria-haspopup="true">
                                                <a href="<?= $app->router()->getRoute('admin_selection_list') ?>" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="kt-menu__link-text">Liste</span>
                                                </a>
                                            </li>
                                            <?php /*
                                            <li class="kt-menu__item <?= selectNavRubrique(['create'], $app->routeName(), 2, ['selection'])?>" aria-haspopup="true">
                                                <a href="<?= $app->router()->getRoute('admin_selection_create') ?>" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="kt-menu__link-text">Ajouter</span>
                                                </a>
                                            </li>
                                             */
                                            ?>
                                        </ul>
                                    </div>
                                </li>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                <li class="kt-menu__item kt-menu__item--submenu<?= selectNavRubrique(['color'], $app->routeName(), 1)?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                        <i class="kt-menu__link-icon fa fa-fill-drip"></i>
                                        <span class="kt-menu__link-text">Couleurs</span>
                                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="kt-menu__submenu " style=""><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item <?= selectNavRubrique(['list'], $app->routeName(), 2, ['color'])?>" aria-haspopup="true">
                                                <a href="<?= $app->router()->getRoute('admin_color_list') ?>" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="kt-menu__link-text">Liste</span>
                                                </a>
                                            </li>
                                            <li class="kt-menu__item <?= selectNavRubrique(['create'], $app->routeName(), 2, ['color'])?>" aria-haspopup="true">
                                                <a href="<?= $app->router()->getRoute('admin_color_create') ?>" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="kt-menu__link-text">Ajouter</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="kt-menu__item kt-menu__item--submenu<?= selectNavRubrique(['favorite'], $app->routeName(), 1)?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                        <i class="kt-menu__link-icon fa fa-user-tie"></i>
                                        <span class="kt-menu__link-text">Favorie</span>
                                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="kt-menu__submenu ">
                                        <span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item <?= selectNavRubrique(['list'], $app->routeName(), 2, ['favorite'])?>" aria-haspopup="true">
                                                <a href="<?= $app->router()->getRoute('admin_favorite_list') ?>" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="kt-menu__link-text">Liste</span>
                                                </a>
                                            </li>
                                            <li class="kt-menu__item <?= selectNavRubrique(['create'], $app->routeName(), 2, ['favorite'])?>" aria-haspopup="true">
                                                <a href="<?= $app->router()->getRoute('admin_favorite_create') ?>" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="kt-menu__link-text">Ajouter</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
							</ul>
						</div>
					</div>

					<!-- end:: Aside Menu -->
				</div>

				<!-- end:: Aside -->
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
                        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
                            </div>
                        </div>
                            <!-- begin:: Header Topbar -->
						<div class="kt-header__topbar">

							<!--end: Quick panel toggler -->

							<!--begin: Language bar Informations utilisateur -->
							<div class="kt-header__topbar-item kt-header__topbar-item--langs">
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
									<span class="kt-header__topbar-icon">
										<img class="" src="<?=$url?>public/assets/images/flag/fr.png" alt="" />
									</span>
								</div>
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">
									<ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
										<li class="kt-nav__item kt-nav__item--active">
											<a href="#" class="kt-nav__link">
												<span class="kt-nav__link-icon"><img src="<?=$url?>public/assets/images/flag/en.png" alt="" /></span>
												<span class="kt-nav__link-text">English</span>
											</a>
										</li>
									</ul>
								</div>
							</div>

							<!--end: Language bar -->

							<!--begin: User Bar -->
							<div class="kt-header__topbar-item kt-header__topbar-item--user">
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
									<div class="kt-header__topbar-user">
										<span class="kt-header__topbar-welcome kt-hidden-mobile">Bonjour,</span>
                                        <span class="kt-header__topbar-username kt-hidden-mobile"><?= utf8_encode($app->user()->getAttribute('first_name')) ?></span>
                                        <!--<img alt="Pic" src="<?=$url?>public/assets/images/user/<?= $app->user()->getAttribute('picture_name') ?>" />-->
									</div>
								</div>
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                                    <!--begin: Navigation -->
                                    <div class="kt-notification">
                                        <div class="kt-notification__custom kt-space-between">
                                            <a href="<?= $app->router()->getRoute('admin_user_update', ['id' => $app->user()->getAttribute('id')]) ?>" class="btn btn-info btn-sm btn-uppe">Modifier mon profil</a>
                                            <a href="<?= $app->router()->getRoute('admin_logout') ?>" class="btn btn-brand btn-sm btn-uppe">Déconnexion</a>
                                        </div>
                                    </div>
								</div>
							</div>

							<!--end: User Bar -->
						</div>

						<!-- end:: Header Topbar -->
					</div>

					
					<?= $blockContent ?>

                    <?php require_once 'footer.php'; ?>
				</div>
			</div>
		</div>

		<!-- end:: Page -->
        <?php require_once 'modals.php'; ?>

		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#2c77f4",
						"light": "#ffffff",
						"dark": "#282a3c",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>
		<script src="<?=$url?>public/assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
		<script src="<?=$url?>public/assets/js/scripts.bundle.js" type="text/javascript"></script>
		<script src="<?=$url?>public/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
		<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
		<script src="<?=$url?>public/assets/plugins/custom/gmaps/gmaps.js" type="text/javascript"></script>
		<script src="<?=$url?>public/assets/js/pages/dashboard.js" type="text/javascript"></script>
	</body>
</html>