<?php
//---------------//
// BLOCK CONTENT //
//---------------//

ob_start();
?>
<form class="kt-form kt-form--label-right" action="edit" method="post" enctype="multipart/form-data">
    <div class="kt-portlet__body">
        <div class="form-group form-group-last">
            <div class="alert alert-secondary" role="alert">
                <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                <div class="alert-text">
                    Choisissez l'association à qui les bénéfisses seront reversés
                    <?php if(!empty($message)){ echo $message;} ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactCharity" class="col-2 col-form-label">Associations</label>
            <div class="col-10">
                <select class="form-control" id="formContactCharity" name="formContactCharity">
                    <?php foreach($charities as $charity ){ ?>
                        <option <?php if($charity['id'] == $user['charity_id']){echo'selected';}?> value="<?=$charity['id']?>" data-img="<?=$url?>public/assets/images/charity_association/<?=$charity['charity_picture']?>"><?= $charity['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-2">
                <img id="imgAssociationShow" src="" class="img-responsive">
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
                    <button type="reset" class="btn btn-secondary">Annuler</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
//-- faire un on change de #formContactCharity , et data-img dans le src de #imgAssociationShow
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
