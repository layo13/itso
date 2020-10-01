<?php
//---------------//
// BLOCK CONTENT //
//---------------//

/* @var $app Epic\BaseApplication */
$app;

ob_start();
?>

    <fieldset>
        <legend>Inscription</legend>

        <?php if ($app->user()->hasFlash()) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $app->user()->getFlash() ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

        <form method="POST" action="<?= $app->router()->getRoute('front_register_exec') ?>">
            <div class="row">
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="option1"
                               checked>
                        <label class="form-check-label" for="gender1">
                            <i class="fa fa-venus"></i>
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="option2">
                        <label class="form-check-label" for="gender2">
                            <i class="fa fa-mars"></i>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="last_name">Nom de famille</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required="required">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="first_name">Prénom</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required="required">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Adresse mail</label>
                        <input type="email" class="form-control" id="email" name="email" required="required">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="password_confirm">Confirmation mot de passe</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="day_of_birth_day">Jour</label>
                        <select class="form-control" id="day_of_birth_day" name="day_of_birth_day">
                            <?php for ($indexJour = 1; $indexJour <= 31; ++$indexJour) { ?>
                                <option value="<?= str_pad((string)$indexJour, 2, "0", STR_PAD_LEFT) ?>"><?= $indexJour ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="day_of_birth_month">Mois</label>
                        <select class="form-control" id="day_of_birth_month" name="day_of_birth_month">
                            <option value="01">Janvier</option>
                            <option value="02">Février</option>
                            <option value="03">Mars</option>
                            <option value="04">Avril</option>
                            <option value="05">Mai</option>
                            <option value="06">Juin</option>
                            <option value="07">Juillet</option>
                            <option value="08">Août</option>
                            <option value="09">Septembre</option>
                            <option value="10">Octobre</option>
                            <option value="11">Novembre</option>
                            <option value="12">Décembre</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="day_of_birth_year">Année</label>
                        <select class="form-control" id="day_of_birth_year" name="day_of_birth_year">
                            <?php for ($indexAnnee = date('Y') - 115; $indexAnnee <= date('Y'); ++$indexAnnee) { ?>
                                <option value="<?= $indexAnnee ?>"><?= $indexAnnee ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success-gr">Inscription</button>
        </form>
    </fieldset>

    <hr/>

    <p>Déjà un compte ? <a href="<?= $app->router()->getRoute('front_login'); ?>">Connectez-vous ici !</a></p>

<?php
$blockContent = ob_get_clean();
require __DIR__ . '/base.php';
