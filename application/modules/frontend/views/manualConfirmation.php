<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 6/22/2017
 * Time: 5:34 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>InCubaTravel - Confirmaci&oacute;n Manual</title>
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.gif"/>
    <link href="<?= base_url() ?>assets/css/incubatravel.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <div class="container">
        <div class="col-sm-12 col-md-5">
            <a title="In Cuba Travel" href="#" class="img-responsive animated fadeInLeft">
                <img class="pull-left" src="<?= base_url() ?>assets/img/logo.png">
            </a>
        </div>
        <div class="col-sm-12 col-md-7">
            <nav class="navbar navbar-default navbar-static-top animate fadeInRight" role="navigation" id="menu">
                <div class="navbar-header">
                    <button data-target=".navbar-ex7-collapse" data-toggle="collapse" class="navbar-toggle"
                            type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse navbar-ex7-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?= base_url('Home') ?>"><i
                                        class="ion-home"></i> <?= $this->lang->line('mn_home') ?></a>
                        </li>
                        <li>
                            <a href="<?= base_url('Policies') ?>"><i
                                        class="ion-hammer"></i> <?= $this->lang->line('mn_policies') ?></a>
                        </li>
                        <li>
                            <a href="<?= base_url('ContactUs') ?>"><i
                                        class="ion-email"></i> <?= $this->lang->line('mn_contactus') ?></a>
                        </li>
                        <li>
                            <a href="<?= base_url('AboutUs') ?>"><i
                                        class="ion-android-people"></i> <?= $this->lang->line('mn_aboutus') ?></a>
                        </li>
                    </ul>
                </div>
            </nav>
            <?php $this->load->view('frontend/headerblocks'); ?>
        </div>
    </div>
</header>
<main>
    <section>
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <?php foreach ($Carousel as $row): ?>
                    <img src="<?= base_url('assets/img/carousel') ?>/<?= $row->Picture ?>" alt=""
                         title="<?= $row->Description ?>"/>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php $this->load->view('frontend/picsection'); ?>
    <section>
        <div class="container">
            <div class="hr-title">CONFIRMACIÓN MANUAL DE SOLICITUD DE PAGO</div>
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-md-5" for="apikey">API KEY<span
                                        class="require"> *</span></label>
                            <div class="col-md-7">
                                <input type="text" id="apikey" class="form-control"
                                       data-bind="textInput: dsend.apikey"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-md-5" for="ict_payid">N&uacute;mero Reserva<span
                                        class="require"> *</span></label>
                            <div class="col-md-7">
                                <input id="ict_payid" class="form-control"
                                       data-bind="textInput: dsend.ict_payid" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="pull-right" style="margin-right: 15px">
                            <button class="btn btn-default"
                                    data-bind="click: sendConfirmation, enable: !errors().length">CONFIRMAR
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php $this->load->view('frontend/footer'); ?>
<script type="text/javascript" src="<?= base_url() ?>assets/js/incubatravel.min.js"></script>
<script type="text/javascript">
    function vmManualConfirmation() {
        var self = this;
        App.initCart(self, "<?=base_url('Api/dCart')?>", "<?=base_url('Checkout')?>");
        App.setCart(<?= $this->ictcart->getItemsJSON() ?>,<?= $this->ictcart->Length() ?>,<?= $this->ictcart->Total() ?>, "<?=$this->session->userdata('currency')?>",<?=$this->session->userdata('rate')?>);
        self.dsend = {
            apikey: ko.observable().extend({required: true}),
            ict_payid: ko.observable("<?=$Payment->ict_payid?>")
        };
        self.errors = ko.validation.group(self.dsend);
        self.sendConfirmation = function () {
            App.ACmd({
                url: "<?=base_url('frontend/Home/executeManualConfirmation')?>",
                data: ko.toJS(self.dsend)
            }).done(function (response) {
                switch (response) {
                    case "Ok":
                        App.ict_Info("La confirmación manual y el envío de mensaje al cliente se completaron");
                        setTimeout(function () {
                            window.location = "<?=base_url('Home')?>";
                        }, 3000);
                        break;
                    case "ErrorApiKey":
                        App.ict_Error("Error en llave de acceso para confirmar pago manual de solicitud");
                        break;
                    case "ErrorDB":
                        App.ict_Error("Error confirmando: DB");
                        break;
                    case "ErrorMail":
                        App.ict_Error("Error enviando mensaje al cliente");
                        break;
                    default:
                        App.ict_Error("Error de comunicación con el servidor");
                }
            });
        };
        self.initControls = function () {
            $('#slider').nivoSlider({controlNav: false});
        };
        self.initControls();
    }
    $(document).ready(function () {
        ko.applyBindings(new vmManualConfirmation());
    });
</script>
</body>
</html>