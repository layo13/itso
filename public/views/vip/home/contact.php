<?php

//---------------//
// BLOCK CONTENT //
//---------------//
ob_start();
?>

<!-- end:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Vous avez des questions?</h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                </div>
            </div>
        </div>
        <!-- begin:: Content -->
        <div class="kt-container  kt-grid__item kt-grid__item--fluid">

            <!-- begin:: Section -->
            <div class="kt-portlet kt-margin-top-30">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Choisissez un sujet et posez nous vos questions!
                        </h3>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="kt-form">
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-xl-3"></div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Nom / prénom</label>
                                    <input type="text" class="form-control" aria-describedby="nameHelp" placeholder="Enter your name">
                                </div>
                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <input type="text" class="form-control" aria-describedby="nameHelp" placeholder="Enter your phone">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea">Message</label>
                                    <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                                    <span class="form-text text-muted">Ajouter RGPD.</span>
                                </div>
                            </div>
                            <div class="col-xl-3"></div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-xl-3"></div>
                                <div class="col-xl-6">
                                    <button type="reset" class="btn btn-success">Submit</button>&nbsp;
                                </div>
                                <div class="col-xl-3"></div>
                            </div>
                        </div>
                    </div>
                </form>

                <!--end::Form-->
            </div>

            <!-- end:: Section -->

            <!-- begin:: Section -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="kt-portlet kt-callout kt-callout--brand kt-callout--diagonal-bg">
                        <div class="kt-portlet__body">
                            <div class="kt-callout__body">
                                <div class="kt-callout__content">
                                    <h3 class="kt-callout__title">Contacter nous direct</h3>
                                    <p class="kt-callout__desc">
                                        Utiliser le Live Chat de votre messagerie
                                    </p>
                                </div>
                                <div class="kt-callout__action">
                                    <a href="#" data-toggle="modal" data-target="#kt_chat_modal" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-brand">Messagerie</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="kt-portlet kt-callout kt-callout--success kt-callout--diagonal-bg">
                        <div class="kt-portlet__body">
                            <div class="kt-callout__body">
                                <div class="kt-callout__content">
                                    <h3 class="kt-callout__title">Appelez Nous</h3>
                                    <p class="kt-callout__desc">
                                        Une urgence? Appelez-nous !
                                    </p>
                                </div>
                                <div class="kt-callout__action">
                                    <a href="#" data-toggle="modal" data-target="#kt_chat_modal" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-success">Appeler</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end:: Section -->
        </div>

        <!-- end:: Content -->
    </div>

<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
