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
                    $brandUrl = "noPhoto.png";
                    if(!empty($brand['brand_picture'])){
                        $brandUrl = $brand['brand_picture'];
                    }
                    ?>
                    <img src="<?= $url ?>public/assets/images/brand/<?= $brandUrl ?>" alt="image">
                </div>
                <div class="kt-widget__content">
                    <div class="kt-widget__head">
                        <div class="kt-widget__user">
                            <a href="#" class="kt-widget__username">
                                <?= $brand['name'] ?>
                            </a>
                            <?php
                            $class_active = 'fa fa-times-circle kt-font-brand';
                            if($brand['active'] == 1){
                                $class_active = 'flaticon2-correct kt-font-success';
                            }
                            ?>
                            <i class="<?= $class_active; ?>"></i>

                        </div>
                        <div class="kt-widget__action">
                            <a href="<?= $app->router()->getRoute('admin_brand_update',['id' => $brand['id']]) ?>" class="btn btn-google btn-sm btn-upper">Modifier</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';