<!DOCTYPE html>
<html lang="fr">

<!-- begin::Head -->
<head>
    <base href="">
    <meta charset="utf-8" />
    <title>Itso</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <link href="/itso/public/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/itso/public/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
    <div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v2 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(<?= ROOT ?>/public/assets/images/background.jpg);">
            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                <div class="kt-login__container">
                    <div class="kt-login__logo">
                        <a href="#">
                            <img src="../itso/public/assets/images/logo.png">
                        </a>
                    </div>
                    <div class="kt-login__signin">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">VIP connexion</h3>
                        </div>
                        <form class="kt-form" action="connexion">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">
                            </div>
                            <div class="input-group">
                                <input class="form-control" type="password" placeholder="Password" name="password">
                            </div>
                            <div class="row kt-login__extra">
                                <div class="col">
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="remember"> Se souvenir de moi
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col kt-align-right">
                                    <a href="javascript:;" id="kt_login_forgot" class="kt-link kt-login__link">Mot de passe oublié ?</a>
                                </div>
                            </div>
                            <div class="kt-login__actions">
                                <button id="kt_login_signin_submit" class="btn btn-pill kt-login__btn-primary">Connexion</button>
                            </div>
                        </form>
                    </div>
                    <div class="kt-login__signup">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Inscription</h3>
                            <div class="kt-login__desc">Renseignez vos informations:</div>
                        </div>
                        <form class="kt-login__form kt-form" action="">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Fullname" name="fullname">
                            </div>
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">
                            </div>
                            <div class="input-group">
                                <input class="form-control" type="password" placeholder="Password" name="password">
                            </div>
                            <div class="input-group">
                                <input class="form-control" type="password" placeholder="Confirm Password" name="rpassword">
                            </div>
                            <div class="row kt-login__extra">
                                <div class="col kt-align-left">
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="agree">Je suis d'accord avec les<a href="#" class="kt-link kt-login__link kt-font-bold"> conditions générals d'utilisation</a>.
                                        <span></span>
                                    </label>
                                    <span class="form-text text-muted"></span>
                                </div>
                            </div>
                            <div class="kt-login__actions">
                                <button id="kt_login_signup_submit" class="btn btn-pill kt-login__btn-primary">Valider</button>&nbsp;&nbsp;
                                <button id="kt_login_signup_cancel" class="btn btn-pill kt-login__btn-secondary">Annuler</button>
                            </div>
                        </form>
                    </div>
                    <div class="kt-login__forgot">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Mot de passe oublié ?</h3>
                            <div class="kt-login__desc">Renseignez votre email pour récupèrer votre mot de passe:</div>
                        </div>
                        <form class="kt-form" action="">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
                            </div>
                            <div class="kt-login__actions">
                                <button id="kt_login_forgot_submit" class="btn btn-pill kt-login__btn-primary">Envoyer</button>&nbsp;&nbsp;
                                <button id="kt_login_forgot_cancel" class="btn btn-pill kt-login__btn-secondary">Annuler</button>
                            </div>
                        </form>
                    </div>
                    <div class="kt-login__account">
								<span class="kt-login__account-msg">
									Vous n'avez pas encore de compte ?
								</span>&nbsp;&nbsp;
                        <a href="javascript:;" id="kt_login_signup" class="kt-link kt-link--light kt-login__account-link">Inscrivez vous</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#2c77f4",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="/itso/public/assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
<script src="/itso/public/assets/js/scripts.bundle.js" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->
<script src="/itso/public/assets/js/pages/custom/login/login-general.js" type="text/javascript"></script>

<!--end::Page Scripts -->


<!-- end::Body -->
</body>
</html>