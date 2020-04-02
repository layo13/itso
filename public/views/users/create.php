<?php
require_once ROOT . '/public/views/admin/up.php';
?>
<form class="kt-form kt-form--label-right" action="add" method="post">
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
            <label for="gender-input" class="col-2 col-form-label">Sexe</label>
            <div class="col-10">
                <span class="kt-switch kt-switch--danger">
						<label>
						    <input type="checkbox" checked="checked" name="gender">
						    <span></span>
						</label>
                </span>
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactLastName" class="col-2 col-form-label">Nom</label>
            <div class="col-10">
                <input class="form-control" type="text" value="Bruno" id="formContactLastName" name="formContactLastName">
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactFirstName" class="col-2 col-form-label">Prénom</label>
            <div class="col-10">
                <input class="form-control" type="search" value="Thomas" id="formContactFirstName" name="formContactFirstName">
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactEmail" class="col-2 col-form-label">Email</label>
            <div class="col-10">
                <input class="form-control" type="email" value="bootstrap@example.com" id="formContactEmail" name="formContactEmail">
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactPassword" class="col-2 col-form-label">Mot de passe</label>
            <div class="col-10">
                <input class="form-control" type="password" value="hunter2" id="formContactPassword" name="formContactPassword">
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactDateOfBirth" class="col-2 col-form-label">Date de naissance</label>
            <div class="col-10">
                <input class="form-control" type="date" value="2011-08-19" id="formContactDateOfBirth" name="formContactDateOfBirth">
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactLanguage" class="col-2 col-form-label">Langue</label>
            <div class="col-10">
                <select class="form-control" id="formContactLanguage" name="formContactLanguage">
                    <option value="1">Français</option>
                    <option value="2">Anglais</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactNationality" class="col-2 col-form-label">Nationnalité</label>
            <div class="col-10">
                <select class="form-control" id="formContactNationality" name="formContactNationality">
                    <option value="1">Français(e)</option>
                    <option value="2">Anglais(e)</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="formContactStatus" class="col-2 col-form-label">Etat</label>
            <div class="col-10">
                <select class="form-control" id="formContactStatus" name="formContactStatus">
                    <option value="1">Nouveau</option>
                    <option value="2">Archivé</option>
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
require_once ROOT . '/public/views/admin/down.php';
?>