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
					Associations
				</h3>
				<span class="kt-subheader__separator kt-subheader__separator--v"></span>
				<div class="kt-subheader__group" id="kt_subheader_search">
					<span class="kt-subheader__desc" id="kt_subheader_total">
						<?= count($charities) ?> Total </span>
					
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
				<a href="#" class="">
				</a>
				<a href="<?= $app->router()->getRoute('admin_charity_create') ?>" class="btn btn-success btn-bold">
					Ajouter une association
                </a>
			</div>
		</div>
	</div>

	<!-- end:: Content Head -->

	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

		<?php foreach($charities as $charity ){ ?>
		
		<!--begin:: Portlet-->
		<div class="kt-portlet">
			<div class="kt-portlet__body">
				<div class="kt-widget kt-widget--user-profile-3">
					<div class="kt-widget__top">
						<div class="kt-widget__media kt-hidden-">
							<img src="<?=$url?>public/assets/images/charity_association/<?=$charity['charity_picture']?>" alt="image">
						</div>
						<div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden">

						</div>
						<div class="kt-widget__content">
							<div class="kt-widget__head">
								<a href="#" class="kt-widget__username">
									<?= $charity['name'] ?>
                                    <?php
                                    $class_active = 'fa fa-times-circle kt-font-brand';
                                    if($charity['active'] == 1){
                                        $class_active = 'flaticon2-correct kt-font-success';
                                    }
                                    ?>
                                    <i class="<?= $class_active; ?>"></i>
								</a>
								<div class="kt-widget__action">
									<a href="<?= $app->router()->getRoute('admin_charity_view',['id'=>$charity['id']]) ?>" type="button" class="btn btn-facebook btn-sm btn-upperr">détail</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php } ?>
		
		<!--end:: Portlet-->
	</div>

	<!-- end:: Content -->
</div>


<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
