<?php
//---------------//
// BLOCK CONTENT //
//---------------//

ob_start();
?>

<style>
    img#imgAssociationShow {
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
                        Ajouter une association
                    </h3>
                </div>
                <div class="kt-subheader__toolbar">
                    <a href="<?= $app->router()->getRoute('admin_charity_list') ?>" class="btn btn-dark btn-bold">
                        Retour liste associations
                    </a>
                </div>
            </div>
        </div>
            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__body">
                    <form class="kt-form kt-form--label-right" action="<?= $app->router()->getRoute('admin_charity_add') ?>" method="post" enctype="multipart/form-data">
                            <div class="kt-portlet__body">
                                <?php if(!empty($message)){ ?>
                                    <div class="form-group form-group-last">
                                        <div class="alert alert-secondary" role="alert">
                                            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                                            <div class="alert-text">
                                                <?= $message;?>
                                            </div>
                                        </div>
                                    </div>
                                <?php  } ?>
                                <div class="form-group row">
                                    <label for="formCharityActive" class="col-2 col-form-label">Activer</label>
                                    <div class="col-4">
                                        <select class="form-control" id="formCharityActive" name="formCharityActive">
                                            <option value="0">Non</option>
                                            <option value="1">Oui</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="formCharityName" class="col-2 col-form-label">Nom</label>
                                    <div class="col-4">
                                        <input required class="form-control" type="text" id="formCharityName" name="formCharityName">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Logo</label>
                                    <div class="col-4">
                                        <div class="kt-portlet kt-portlet--height-fluid">
                                            <div class="kt-portlet__head">
                                                <div class="kt-portlet__head-label">
                                                    <h3 class="kt-portlet__head-title">
                                                        Chargement facile
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body">
                                                <div class="kt-uppy" id="kt_uppy_3">
                                                    <div class="kt-uppy__drag">
                                                        <button type="button" class="uppy-Root uppy-u-reset uppy-DragDrop-container uppy-DragDrop--is-dragdrop-supported" style="width: 100%; height: 100%;">
                                                            <input class="uppy-DragDrop-input" type="file" tabindex="-1" focusable="false" name="formCharityFile" accept="image/*">
                                                            <div class="uppy-DragDrop-inner">
                                                                <svg aria-hidden="true" focusable="false" class="UppyIcon uppy-DragDrop-arrow" width="16" height="16" viewBox="0 0 16 16">
                                                                    <path d="M11 10V0H5v10H2l6 6 6-6h-3zm0 0" fill-rule="evenodd"></path>
                                                                </svg>
                                                                <div class="uppy-DragDrop-label">Glisser / déposer votre photo
                                                                    <span class="uppy-DragDrop-browse">Bureau</span>
                                                                </div>
                                                                <span class="uppy-DragDrop-note"></span>
                                                            </div>
                                                        </button>
                                                    </div>
                                                    <div class="kt-uppy__informer"><div class="uppy uppy-Informer" aria-hidden="true"><p role="alert"> </p></div></div>
                                                    <div class="kt-uppy__thumbnails"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-2">
                                    </div>
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-success">Enregister</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
?>
