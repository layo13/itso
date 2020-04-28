<?php

//---------------//
// BLOCK CONTENT //
//---------------//
ob_start();
?>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Ajouter un nouveau produit
                </h3>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="<?= $app->router()->getRoute('vip_product_list') ?>" class="btn btn-default btn-bold">
                    Retour au listing
                </a>
            </div>
        </div>
    </div>
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__body">
            <form class="kt-form kt-form--label-right" action="add" method="post" enctype="multipart/form-data">
        <div class="kt-portlet__body">
            <div class="form-group row">
                <label class="col-2 col-form-label">Photo du produit</label>
                <div class="col-10">
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
                                        <input class="uppy-DragDrop-input" type="file" tabindex="-1" focusable="false" name="File" accept="image/*,video/*">
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
            </div>
            <div class="form-group row">
                <label for="formContactStatus" class="col-2 col-form-label">Choisir la marque</label>
                <div class="col-10">
                    <select class="form-control" id="formContactStatus" name="formContactStatus">
                        <?php
                        foreach($brands as $brand){
                            ?>
                            <option value="<?= $brand['id']?>"><?= $brand['name']?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="formContactStatus" class="col-2 col-form-label">Choisir la catégorie du produit</label>
                <div class="col-10" id="formChoixParentCategory">
                    <select class="form-control formChoixChild" id="formChoixParentCategory">
                        <option value="">Premier choix...</option>
                        <?php
                        foreach($product_category as $category ){
                            ?>
                            <option value="<?= $category['id']?>"><?= $category['name']?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="LastName" class="col-2 col-form-label">Titre / où le produit a été porté</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="Bruno" id="LastName" name="LastName">
                </div>
            </div>
            <div class="form-group row">
                <label for="LastName" class="col-2 col-form-label">Url de la boutique</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="Bruno" id="LastName" name="LastName">
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