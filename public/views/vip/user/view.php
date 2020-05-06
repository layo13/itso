<?php
//---------------//
// BLOCK CONTENT //
//---------------//

ob_start();
?>
<div class="kt-portlet">
    <div class="kt-portlet__body">
        <div class="kt-widget kt-widget--user-profile-3">
            <div class="kt-widget__top">
                <div class="kt-widget__media">
                    <?php
                    $userPictureUrl = "noPhoto.png";
                    if(!empty($user['user_picture'])){
                        $userPictureUrl = $user['user_picture'];
                    }
                    ?>
                    <img src="<?= $url ?>public/assets/images/users/<?= $userPictureUrl ?>" alt="image">
                </div>
                <div class="kt-widget__content">
                    <div class="kt-widget__head">
                        <div class="kt-widget__user">
                            <a href="#" class="kt-widget__username">
                                <?= $user['first_name'] ." ".$user['last_name'] ." ". getGender($user['gender'])?>
                            </a>
                            <span class="kt-badge kt-badge--bolder kt-badge kt-badge--inline kt-badge--unified-success"><?= getUserEtat($user['state']) ?></span>

                        </div>
                        <div class="kt-widget__action">
                            <a href="<?= $app->router()->getRoute('vip_user_update',['id' => $user['id']]) ?>" class="btn btn-label-danger btn-sm btn-upper">Modifier mes informations</a>
                        </div>
                    </div>
                    <div class="kt-widget__subhead">
                        <a href="#"><i class="flaticon2-new-email"></i><?= $user['email'] ?></a>
                        <a href="#"><i class="flaticon2-placeholder"></i><img src="<?= $url . getCountrieFlag($user['nationality']) ?>"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';