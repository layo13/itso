<?php
require_once ROOT . '/public/views/admin/up.php';
?>
<div class="kt-portlet">
    <div class="kt-portlet__body">
        <div class="kt-widget kt-widget--user-profile-3">
            <div class="kt-widget__top">
                <div class="kt-widget__media">
                    <?php
                    $userPictureUrl = "noPhoto.png";
                    if(!empty($user['user_picture'])){
                        $userPictureUrl = "users/".$user['user_picture'];
                    }
                    ?>
                    <img src="../public/assets/images/<?= $userPictureUrl ?>" alt="image">
                </div>
                <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-bolder kt-font-light kt-hidden">
                    JM
                </div>
                <div class="kt-widget__content">
                    <div class="kt-widget__head">
                        <div class="kt-widget__user">
                            <a href="#" class="kt-widget__username">
                                <?= $user['firstname'] ." ".$user['name'] ." ". getGender($user['gender'])?>
                            </a>
                            <span class="kt-badge kt-badge--bolder kt-badge kt-badge--inline kt-badge--unified-success"><?= getUserEtat($user['state']) ?></span>
                            <div class="dropdown dropdown-inline kt-margin-l-5" data-toggle="kt-tooltip-" title="Change label" data-placement="right">
                                <a href="#" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-caret-down"></i>
                                </a>
                            </div>
                        </div>
                        <div class="kt-widget__action">
                            <a href="#" class="btn btn-label-brand btn-sm btn-upper">Contact</a>
                        </div>
                    </div>
                    <div class="kt-widget__subhead">
                        <a href="#"><i class="flaticon2-new-email"></i><?= $user['email'] ?></a>
                        <a href="#"><i class="flaticon2-placeholder"></i><img src="<?= getCountrieFlag($user['nationality']) ?>"></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once ROOT . '/public/views/admin/down.php';
?>