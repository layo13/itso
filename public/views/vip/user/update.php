<?php
require_once ROOT . '/public/views/vip/up.php';
?>
<form class="kt-form kt-form--label-right" action="add" method="post" enctype="multipart/form-data">
    <div class="kt-portlet__body">
        <div class="form-group form-group-last">
            <div class="alert alert-secondary" role="alert">
                <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                <div class="alert-text">
                    Ajouter un utilisateur
                    <?php if(!empty($message)){ echo $message;} ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label">Photo de profil</label>
            <div class="col-10">
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
                                    <input class="uppy-DragDrop-input" type="file" tabindex="-1" focusable="false" name="formContactFile" accept="image/*">
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
                            <div class="kt-uppy__progress"><div class="uppy uppy-ProgressBar" style="position: initial;"><div class="uppy-ProgressBar-inner" style="width: 0%;"></div><div class="uppy-ProgressBar-percentage">0</div></div></div>
                            <div class="kt-uppy__thumbnails"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="gender-input" class="col-2 col-form-label">Sexe</label>
            <div class="col-10">
                <span class="kt-switch kt-switch--danger">
						<label>
						    <input type="checkbox" <?php if($gender == 1){ echo "checked=\"checked\"";} ?> name="gender">
						    <span></span>
						</label>
                </span>
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactLastName" class="col-2 col-form-label">Nom</label>
            <div class="col-10">
                <input required class="form-control" type="text" value="<?= $last_name ?>" id="formContactLastName" name="formContactLastName">
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactFirstName" class="col-2 col-form-label">Prénom</label>
            <div class="col-10">
                <input required class="form-control" type="text" value="<?= $first_name ?>" id="formContactFirstName" name="formContactFirstName">
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactEmail" class="col-2 col-form-label">Email</label>
            <div class="col-10">
                <input required class="form-control" type="email" value="<?= $email ?>" id="formContactEmail" name="formContactEmail">
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactPassword" class="col-2 col-form-label">Mot de passe</label>
            <div class="col-10">
                <input required class="form-control" type="password" value="<?= $password ?>" id="formContactPassword" name="formContactPassword">
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactDateOfBirth" class="col-2 col-form-label">Date de naissance</label>
            <div class="col-10">
                <input required class="form-control" type="date" value="<?= $day_of_birth ?>" id="formContactDateOfBirth" name="formContactDateOfBirth">
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactLanguage" class="col-2 col-form-label">Langue</label>
            <div class="col-10">
                <select class="form-control" id="formContactLanguage" name="formContactLanguage">
                    <option <?php if($language == 1){echo'selected';}?> value="1">Français</option>
                    <option <?php if($language == 2){echo'selected';}?> value="2">Anglais</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactNationality" class="col-2 col-form-label">Nationnalité</label>
            <div class="col-10">
                <select class="form-control" id="formContactNationality" name="formContactNationality">
                    <option <?php if($nationality == 1){echo'selected';}?> value="1">Français(e)</option>
                    <option <?php if($nationality == 2){echo'selected';}?> value="2">Anglais(e)</option>
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
                    <button type="reset" class="btn btn-secondary">Annuler</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
require_once ROOT . '/public/views/vip/down.php';
?>