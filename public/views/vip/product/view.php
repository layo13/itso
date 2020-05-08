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
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <!-- vers formulaire de contact -->
                <a href="<?= $app->router()->getRoute('vip_product_create') ?>" class="btn btn-success btn-bold">Ajouter un produit</a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__body kt-portlet__body--fit">

                        <!--begin::Widget -->
                        <div class="kt-widget kt-widget--project-1">
                            <div class="kt-widget__head">
                                <div class="kt-widget__label">
                                    <div class="kt-widget__media">
											<span class="kt-media kt-media--lg kt-media--circle">
                                                <?php
                                                if(!empty($productsPicture[$product['id']])){
                                                    ?>
                                                    <img src="<?=$url?>public/assets/images/product/<?= $productsPicture[$product['id']][0]['name'] ?>" alt="image">
                                                    <?php
                                                }
                                                ?>
											</span>
                                    </div>
                                    <div class="kt-widget__info kt-margin-t-5">
                                        <a href="/itso/product/view,<?= $product['id'] ?>" class="kt-widget__title">
                                            <?= $product['name'] ?>
                                        </a>
                                        <span class="kt-widget__desc">
                                            <?= utf8_encode($product['product_category']) ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                        <i class="flaticon-more-1"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                        <ul class="kt-nav">
                                            <li class="kt-nav__item">
                                                <!-- modification champs state ou actif à voir -->
                                                <a href="#" data-productId="<?= intval($product['id']) ?>" data-active="<?= intval($product['active']) ?>" class="kt-nav__link changePublishProduct">
                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                    <span class="kt-nav__link-text">
                                                        <?php
                                                        if($product['active']==0) {
                                                            echo "Publier";
                                                        }else{
                                                            echo "Dépublier";
                                                        }
                                                        ?>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="<?= $app->router()->getRoute('vip_product_update',['id'=>intval($product['id'])]) ?>" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                    <span class="kt-nav__link-text">Modifier</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-widget__body">
                                <div class="kt-widget__stats">
                                    <div class="kt-widget__item">
										<span class="kt-widget__date">
											Publié
										</span>
                                        <div class="kt-widget__label"> <?php
                                            if($product['active']==1) {
                                                ?>
                                                <span class="btn btn-success btn-sm btn-bold btn-upper">Publié</span>
                                                <?php
                                            }else{
                                                ?>
                                                <span class="btn btn-brand btn-sm btn-bold btn-upper">Non publié</span>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="kt-widget__item">
										<span class="kt-widget__date">
											Etat
										</span>
                                        <div class="kt-widget__label">
                                            <?php
                                            if($product['state']==1) {
                                                ?>
                                                <span class="btn btn-success btn-sm btn-bold btn-upper">Actif</span>
                                                <?php
                                            }else{
                                                ?>
                                                <span class="btn btn-brand btn-sm btn-bold btn-upper">Archivé</span>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <span class="kt-widget__text">
                                    <?php
                                    if(!empty($productLink[$product['id']])){
                                        foreach ($productLink[$product['id']] as $link) {
                                            ?>
                                            <a href="<?= $link['url'] ?>"><?= $link['url'] ?></a>
                                            <?php
                                        }
                                    }
                                    ?>
                                </span>
                                <div class="kt-widget__content">
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__subtitle">Couleur principale</span>
                                        <span class="kt-widget__value"><?= $product['main_color']?></span>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__subtitle">Marque</span>
                                        <span class="kt-widget__value"><?= $product['brand_name']?></span>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__subtitle">Photos</span>
                                        <div class="kt-media-group">
                                            <?php
                                            if(!empty($productLink[$product['id']])){
                                                foreach ($productsPicture[$product['id']] as $picture) {
                                                    ?>
                                                    <a href="#" class="kt-media kt-media--sm kt-media--circle"
                                                       data-toggle="kt-tooltip" data-skin="brand"
                                                       data-placement="top" title="" data-original-title="<?= $picture['name'] ?>">
                                                        <img src="<?= $url ?>public/assets/images/product/<?= $picture['name'] ?>"
                                                             alt="image">
                                                    </a>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-widget__footer">
                                <div class="kt-widget__wrapper">
                                    <div class="kt-widget__section">
                                        <div class="kt-widget__blog">
                                            <i class="fa fa-mouse-pointer kt-font-dark"></i>
                                            <a href="#" class="kt-widget__value kt-font-brand">
                                                <?php
                                                if(!empty($nbProductLinkClick[$product['id']])){
                                                    echo $nbProductLinkClick[$product['id']]['nb_product_link_click'];
                                                }else{
                                                    echo '0';
                                                }
                                                ?>
                                                Clicks</a>
                                        </div>
                                        <div class="kt-widget__blog">
                                            <i class="fab fa-gratipay kt-font-dark"></i>
                                            <a href="#" class="kt-widget__value kt-font-brand">
                                                <?php
                                                if(!empty($nbProductLike[$product['id']])){
                                                    echo $nbProductLike[$product['id']]['nb_product_like'];
                                                }else{
                                                    echo '0';
                                                }
                                                ?>
                                                Like</a>
                                        </div>
                                    </div>
                                    <div class="kt-widget__section">
                                        <a href="<?= $app->router()->getRoute('vip_product_update',['id'=>$product['id']]) ?>" class="btn btn-brand btn-sm btn-upper btn-bold">Modifier</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Widget -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var urlChangePublishProduct = '<?= $app->router()->getRoute('vip_product_publish') ?>';
    var urlReloadList = '<?= $app->router()->getRoute('vip_product_view',['id'=>$product['id']]) ?>';
</script>


<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
?>
<script type="text/javascript" src="<?= $url ?>public/assets/js/product_list.js"></script>