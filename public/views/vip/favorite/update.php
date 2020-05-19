<?php
//---------------//
// BLOCK CONTENT //
//---------------//

ob_start();
?>

<style>
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
                        Ajouter une catégorie de favorie
                    </h3>
                </div>
                <div class="kt-subheader__toolbar">
                    <a href="<?= $app->router()->getRoute('vip_favorite_list') ?>" class="btn btn-dark btn-bold">
                        Retour liste associations
                    </a>
                </div>
            </div>
        </div>
            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__body">
                    <form class="kt-form kt-form--label-right" action="<?= $app->router()->getRoute('vip_favorite_edit',['id' => $user_favorite_category['id']]) ?>" method="post" enctype="multipart/form-data">
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
                                        <option <?php if($user_favorite_category['active'] == 0){echo'selected';}?> value="0">Non</option>
                                        <option <?php if($user_favorite_category['active'] == 1){echo'selected';}?> value="1">Oui</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="formCharityName" class="col-2 col-form-label">Nom</label>
                                <div class="col-4">
                                    <input required class="form-control" type="text" value="<?= $user_favorite_category['name'] ?>" id="formCharityName" name="formCharityName">
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
