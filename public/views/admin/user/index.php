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
					Utilisateurs
				</h3>
				<span class="kt-subheader__separator kt-subheader__separator--v"></span>
				<div class="kt-subheader__group" id="kt_subheader_search">
					<span class="kt-subheader__desc" id="kt_subheader_total">
						<?php
                        if(!empty($users)) {
                            echo count($users);
                        }else{
                            ?>
                            0
                            <?php
                        }
                        ?> Total
                    </span>
				</div>
				<div class="kt-subheader__group kt-hidden" id="kt_subheader_group_actions">
					<div class="kt-subheader__desc"><span id="kt_subheader_group_selected_rows"></span> Selected:</div>
					<div class="btn-toolbar kt-margin-l-20">
						<div class="dropdown" id="kt_subheader_group_actions_status_change">
							<button type="button" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">
								Update Status
							</button>
							<div class="dropdown-menu">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first">
										<span class="kt-nav__section-text">Change status to:</span>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="1">
											<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-success kt-badge--inline kt-badge--bold">Approved</span></span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="2">
											<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-danger kt-badge--inline kt-badge--bold">Rejected</span></span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="3">
											<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-warning kt-badge--inline kt-badge--bold">Pending</span></span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="4">
											<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-info kt-badge--inline kt-badge--bold">On Hold</span></span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<button class="btn btn-label-success btn-bold btn-sm btn-icon-h" id="kt_subheader_group_actions_fetch" data-toggle="modal" data-target="#kt_datatable_records_fetch_modal">
							Fetch Selected
						</button>
						<button class="btn btn-label-danger btn-bold btn-sm btn-icon-h" id="kt_subheader_group_actions_delete_all">
							Delete All
						</button>
					</div>
				</div>
			</div>
			<div class="kt-subheader__toolbar">
				<a href="<?= $app->router()->getRoute('admin_user_create') ?>" class="btn btn-success btn-bold">
					Ajouter un utilisateur
                </a>
			</div>
		</div>
	</div>

	<!-- end:: Content Head -->

	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

		<?php
        if(!empty($users)) {
            foreach ($users as $user) {
                ?>
                <!--begin:: Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <div class="kt-widget kt-widget--user-profile-3">
                            <div class="kt-widget__top">
                                <div class="kt-widget__media kt-hidden-">
                                    <?php
                                    $userPictureUrl = "noPhoto.png";
                                    if (!empty($user['user_picture'])) {
                                        $userPictureUrl = $user['user_picture'];
                                    }
                                    ?>
                                    <img src="<?= $url ?>public/assets/images/user/<?= $userPictureUrl ?>" alt="image">
                                </div>
                                <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden">

                                </div>
                                <div class="kt-widget__content">
                                    <div class="kt-widget__head">
                                        <a href="#" class="kt-widget__username">
                                            <?= $user['first_name'] ?> <?= $user['last_name'] ?>
                                            <?php
                                            $class_active = 'fa fa-times-circle kt-font-brand';
                                            if ($user['active'] == 1) {
                                                $class_active = 'flaticon2-correct kt-font-success';
                                            }
                                            ?>
                                            <i class="<?= $class_active; ?>"></i>
                                            <?= getGender($user['gender']); ?>
                                        </a>
                                        <div class="kt-widget__action">
                                            <a href="<?= $app->router()->getRoute('admin_user_view', ['id' => $user['id']]) ?>"
                                               class="btn btn-facebook btn-sm btn-upper">Détail</a>&nbsp;
                                            <a href="<?= $app->router()->getRoute('admin_user_update', ['id' => $user['id']]) ?>"
                                               class="btn btn-dark btn-sm btn-upper">Modifier</a>
                                            <?php
                                            if ($user['active'] == 1) {
                                                ?>
                                                <a href="" class="btn btn-brand btn-sm btn-upper">Désactiver</a>
                                                <?php
                                            } else {
                                                ?>
                                                <a href="" class="btn btn-success btn-sm btn-upper">Activer</a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="#"><i class="flaticon2-new-email"></i><?= $user['email'] ?></a>
                                        <a href="#"><i class="flaticon2-calendar-3"></i><?= $user['user_type_name'] ?>
                                        </a>
                                        <a href="#"><img src="<?= $url . getCountrieFlag($user['nationality']) ?>"></a>
                                    </div>
                                    <div class="kt-widget__info">
                                        <div class="kt-widget__desc">
                                            <?php if (!empty($user['celebrity_category_name'])) { ?> Catégories : <?= $user['celebrity_category_name']; ?><?php } ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="kt-widget__bottom">
                                <?php if (!empty($nbProduct[$user['id']])) { ?>
                                    <div class="kt-widget__item">
                                        <div class="kt-widget__icon">
                                            <i class="flaticon2-box-1"></i>
                                        </div>
                                        <div class="kt-widget__details">
                                            <span class="kt-widget__title">Produits</span>
                                            <span class="kt-widget__value"><?= $nbProduct[$user['id']]['nb_product'] ?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($nbSubscriber[$user['id']])) { ?>
                                    <div class="kt-widget__item">
                                        <div class="kt-widget__icon">
                                            <i class="flaticon2-avatar"></i>
                                        </div>
                                        <div class="kt-widget__details">
                                            <span class="kt-widget__title">Abonnés</span>
                                            <span class="kt-widget__value"><?= $nbSubscriber[$user['id']]['nb_subscriber'] ?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($nbTotalLike[$user['id']])) { ?>
                                    <div class="kt-widget__item">
                                        <div class="kt-widget__icon">
                                            <i class="flaticon2-chart"></i>
                                        </div>
                                        <div class="kt-widget__details">
                                            <span class="kt-widget__title">Likes</span>
                                            <span class="kt-widget__value"><?= $nbTotalLike[$user['id']]['nb_product_like'] ?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($user['charity_name'])) { ?>
                                    <div class="kt-widget__item">
                                        <div class="kt-widget__icon">
                                            <i class="flaticon-black"></i>
                                        </div>
                                        <div class="kt-widget__details">
                                            <span class="kt-widget__title">Association</span>
                                            <span class="kt-widget__value"><?= $user['charity_name'] ?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-confetti"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Date de naissance</span>
                                        <span class="kt-widget__value"><?= strftime("%A %d %B %G", strtotime($user['day_of_birth'])); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php }
        }?>
		
		<!--end:: Portlet-->
	</div>

	<!-- end:: Content -->
</div>


<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
