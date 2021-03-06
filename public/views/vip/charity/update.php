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
                    Choisir mon association
                </h3>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="<?= $app->router()->getRoute('vip_user_profil') ?>" class="btn btn-success btn-bold">
                    Retour au profil
                </a>
                <a href="<?= $app->router()->getRoute('vip_charity_list') ?>" class="btn btn-dark btn-bold">
                    Retour liste association
                </a>
            </div>
        </div>
    </div>
    <div class="kt-portlet kt-portlet--tabs">
    <div class="kt-portlet__body">
<form class="kt-form kt-form--label-right" action="<?= $app->router()->getRoute('vip_charity_edit') ?>" method="post" enctype="multipart/form-data">
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
            <label for="formContactCharity" class="col-2 col-form-label">Associations</label>
            <div class="col-7">
                <select class="form-control" id="formContactCharity" name="formContactCharity">
                    <?php foreach($charities as $charity ){ ?>
                        <option <?php if($charity['id'] == $user['charity_id']){echo'selected';}?> value="<?=$charity['id']?>" data-img="<?=$charity['charity_picture']?>">
                            <?= $charity['name'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-3">
                <img id="imgAssociationShow" src="<?= $imgCharity ?>" class="img-responsive">
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
<script type="text/javascript" src="<?= $url ?>public/assets/js/charity_choice.js"></script>
