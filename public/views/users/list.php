<?php
require_once ROOT . '/public/views/admin/up.php';
foreach ($users as $i => $user) {
    if(est_multiple($i, 4) || $i == 0){
    ?>
        <div class="row">
    <?php
    }
    ?>
        <div class="col-xl-3">

            <!--Begin::Portlet-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--noborder">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-expanded="false">
                            <i class="flaticon-more-1 kt-font-brand"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
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
                <div class="kt-portlet__body">

                    <!--begin::Widget -->
                    <div class="kt-widget kt-widget--user-profile-2">
                        <div class="kt-widget__head">
                            <div class="kt-widget__media">
                                <img class="kt-widget__img kt-hidden-" src="../public/assets/images/noPhoto.png" alt="image">
                                <div
                                    class="kt-widget__pic kt-widget__pic--success kt-font-success kt-font-boldest kt-hidden">
                                    ChS
                                </div>
                            </div>
                            <div class="kt-widget__info">
                                <a href="#" class="kt-widget__username">
                                    <?= $user['firstname'] ." ".$user['name'] ?>
                                </a>
                                <span class="kt-widget__desc">
                                    <?= $user['state'] ?>
								</span>
                            </div>
                        </div>
                        <div class="kt-widget__body">
                            <!--<div class="kt-widget__section"></div>-->
                            <div class="kt-widget__item">
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Email:</span>
                                    <a href="#" class="kt-widget__data"><?= $user['email'] ?></a>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Password:</span>
                                    <a href="#" class="kt-widget__data"><?= $user['password'] ?></a>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Langue:</span>
                                    <a href="#" class="kt-widget__data"><?= $user['language'] ?></a>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Nationalité:</span>
                                    <span class="kt-widget__data"><?= $user['nationality'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget__footer">
                            <button type="button" class="btn btn-label-brand btn-lg btn-upper">Plus de détail</button>
                        </div>
                    </div>

                    <!--end::Widget -->
                </div>
            </div>

            <!--End::Portlet-->
        </div>
    <?php
    }if(est_multiple($i, 4)){
    ?>
     </div>
    <?php
}
require_once ROOT . '/public/views/admin/down.php';
?>