<?php

//---------------//
// BLOCK CONTENT //
//---------------//
ob_start();
?>
<style>
    img#brandPictureShow {
        position: relative;
        display: block;
        width: 100%;
    }
    i#formProductColorDemo {
        font-size: 35px;
        vertical-align: middle;
        position: relative;
        display: block;
    }
    img.img-responsive {
        position: relative;
        display: block;
        width: 100%;
    }
</style>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Ajouter un nouveau produit
                </h3>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="<?= $app->router()->getRoute('vip_product_list') ?>" class="btn btn-facebook btn-bold">
                    Retour au listing
                </a>
            </div>
        </div>
    </div>
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__body">
            <form class="kt-form kt-form--label-right" action="<?= $app->router()->getRoute('vip_product_edit',['id'=>$product['id']]) ?>" method="post" enctype="multipart/form-data">
        <div class="kt-portlet__body">
            <div class="form-group row">
                <label for="formProductName" class="col-2 col-form-label">Titre / où le produit a été porté</label>
                <div class="col-4">
                    <input class="form-control" type="text" value="<?= $product['name'] ?>" id="formProductName" name="formProductName">
                </div>
            </div>
            <div class="form-group row">
                <label for="formChoixParentCategory" class="col-2 col-form-label">Choisir la catégorie du produit</label>
                <div class="col-2" id="formChoixParentCategory">
                    <select class="form-control formChoixChild" id="formChoixParentCategory">
                        <option value="">Premier choix...</option>
                        <?php
                        foreach($product_category as $category){
                            ?>
                            <optgroup label="<?= utf8_encode($category['value']['name'])?>">
                                <?php
                                foreach($category['children'] as $child ){
                                    ?>
                                    <!--<option <?php if($product['product_type_id'] == $child['value']['id']){echo'selected';} ?> value="<?= $child['value']['id']?>"><?= utf8_encode($child['value']['name'])?></option>-->
                                    <option <?php if($categoryProductSelect['id'] == $child['value']['id'] || $categoryProductSelect['parent_id'] == $child['value']['id']){echo'selected';} ?> value="<?= $child['value']['id']?>"><?= utf8_encode($child['value']['name'])?></option>
                                    <?php
                                }
                                ?>
                            </optgroup>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-3" id="formChoixParentChildren">
                </div>
            </div>
            <div class="form-group row">
                <label for="formProductMainColorId" class="col-2 col-form-label">Choisir la couleur principale</label>
                <div class="col-2">
                    <select class="form-control" id="formProductMainColorId" name="formProductMainColorId">
                        <?php
                        foreach($colors as $color){
                            ?>
                            <option value="<?= $color['id']?>" <?php if($product['main_color_id'] == $color['id']){echo'selected';} ?> data-color="<?= $color['hex'] ?>"><?= $color['name'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-2">
                    <i id="formProductColorDemo" class="fa fa-square-full" style="color: <?= $colors[0]['hex'];?>"></i>
                </div>
            </div>
            <div class="form-group row">
                <label for="formProductBrandId" class="col-2 col-form-label">Choisir la marque</label>
                <div class="col-3">
                    <select class="form-control" id="formProductBrandId" name="formProductBrandId">
                        <?php
                        foreach($brands as $brand){
                            ?>
                            <option value="<?= $brand['id']?>" <?php if($product['brand_id'] == $brand['id']){echo'selected'; $imgProduct = $brand['brand_picture'];}?> data-img="<?=$url?>public/assets/images/brand/<?= $brand['brand_picture'] ?>"><?= $brand['name']?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-2"></div>
                <div class="col-2">
                    <?php
                    if(empty($imgProduct)){
                        $imgProduct = $brands[0]['brand_picture'];
                    }
                    ?>
                    <img id="brandPictureShow" src="<?=$url?>public/assets/images/brand/<?= $imgProduct ?>" class="img-responsive">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Photo du produit</label>
                <div class="col-4">
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Déposer / choisissez votre photo
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-uppy" id="kt_uppy_3">
                                <div class="kt-uppy__drag">
                                    <button type="button" class="uppy-Root uppy-u-reset uppy-DragDrop-container uppy-DragDrop--is-dragdrop-supported" style="width: 100%; height: 100%;">
                                        <input class="uppy-DragDrop-input" type="file" tabindex="-1" focusable="false" name="formProductFile" accept="image/*">
                                        <div class="uppy-DragDrop-inner">
                                            <svg aria-hidden="true" focusable="false" class="UppyIcon uppy-DragDrop-arrow" width="16" height="16" viewBox="0 0 16 16">
                                                <path d="M11 10V0H5v10H2l6 6 6-6h-3zm0 0" fill-rule="evenodd"></path>
                                            </svg>
                                            <div class="uppy-DragDrop-label">Déposer la photo ici
                                                <span class="uppy-DragDrop-browse">browse</span>
                                            </div>
                                            <span class="uppy-DragDrop-note"></span>
                                        </div>
                                    </button>
                                </div>
                                <div class="kt-uppy__informer"><div class="uppy uppy-Informer" aria-hidden="true"><p role="alert"> </p></div></div>
                                <div class="kt-uppy__progress"><div class="uppy uppy-ProgressBar" style="position: initial;"><div class="uppy-ProgressBar-inner" style="width: 0%;"></div><div class="uppy-ProgressBar-percentage">0</div></div></div>
                                <div class="kt-uppy__thumbnails"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <?php
                    if(!empty($productsPicture)) {
                        foreach ($productsPicture as $picture) {
                            ?>
                            <img src="<?= $url ?>public/assets/images/product/<?= $picture['name'] ?>" class="img-responsive">
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="formProductLink" class="col-2 col-form-label">Url de la boutique</label>
                <div class="col-4">
                    <?php
                    foreach ($productsLink as $link) {
                        ?>
                        <div class="row linkRowBloc">
                            <div class="col-9">
                                <input class="form-control" type="text" value="<?= $link['url']?>" name="formProductLink[]">
                            </div>
                            <div class="col-3">
                                <a href="#" class="btn btn-brand btn-sm btn-upper delete-linkRowBloc" title="Supprimer ce lien"><i class="fa fa-trash"></i></a>
                                <a href="#" class="btn btn-success btn-sm btn-upper new-linkRowBloc" title="Ajouter un lien"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="formProductActive" class="col-2 col-form-label">Publication</label>
                <div class="col-2">
                    <select class="form-control" name="formProductActive">
                        <option <?php if($product['active'] == 0){echo'selected';} ?> value="0">Dépublier</option>
                        <option <?php if($product['active'] == 1){echo'selected';} ?> value="1">Publier</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-10">
                        <button type="submit" class="btn btn-success">Enregister</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
        </div>
    </div>
</div>
<script>
    var urlChangeCategoryProduct = '<?= $app->router()->getRoute('vip_category_select') ?>';
</script>
<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
?>
<script type="text/javascript" src="<?= $url ?>public/assets/js/product_create.js"></script>