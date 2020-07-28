<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 7/4/2017
 * Time: 6:12 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="description" content="InCuba Travel Site"/>
    <meta name="keywords"
          content="incuba, cuba, travel, events, hotels, roundtrips, packages, tours, tourism, excursion, cars, rent"/>
    <meta name="robots" content="no-cache"/>
    <title>InCubaTravel - Cars</title>
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
            <div class="hr-title">TASAS DE CAMBIO ACTUALIZADAS</div>
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
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
                    <hr>
                    <div class="row">
                        <table class="table table-responsive">
                            <tr>
                                <th>Nombre</th>
                                <th>Código</th>
                                <th>Tasa</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                            <tbody data-bind="foreach: currencies">
                            <tr>
                                <td class="middle" data-bind="text: Name"></td>
                                <td class="middle" data-bind="text: ISOCode"></td>
                                <td class="middle" data-bind="text: Rate"></td>
                                <td class="middle" data-bind="text: UpdateDate"></td>
                                <td><button class="btn btn-info" data-bind="click: $parent.changeRate">Cambiar</button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php $this->load->view('frontend/footer'); ?>
<script type="text/javascript" src="<?= base_url() ?>assets/js/incubatravel.min.js"></script>
<script type="text/javascript">
    function vmChangeRate() {
        var self = this;
        App.initCart(self, "<?=base_url('Api/dCart')?>", "<?=base_url('Checkout')?>");
        App.setCart(<?= $this->ictcart->getItemsJSON() ?>,<?= $this->ictcart->Length() ?>,<?= $this->ictcart->Total() ?>, "<?=$this->session->userdata('currency')?>",<?=$this->session->userdata('rate')?>);
        self.dsend = {
            apikey: ko.observable("<?=$this->uri->segment(2)?>").extend({required: true}),
            isocode: ko.observable(),
            rate: ko.observable().extend({required: true})
        };
        self.currencies = ko.observableArray(<?=json_encode($Currencies)?>);
        self.errors = ko.validation.group(self.dsend);
        self.changeRate = function(data){
            console.log(arguments);
            var rate = prompt("Valor de la nueva Tasa de Cambio",data.Rate);
            if (rate && !isNaN(parseFloat(rate))){
                self.dsend.isocode(data.ISOCode);
                self.dsend.rate(rate);
                App.ACmd({
                    url: "<?=base_url('frontend/Home/changeRate')?>",
                    data: ko.toJS(self.dsend)
                },"json").done(function (response) {
                    switch (response.code) {
                        case "Ok":
                            App.ict_Info("La tasa de cambio se actualizó con éxito");
                            self.currencies.removeAll();
                            self.currencies(response.currencies);
                            break;
                        case "ErrorApiKey":
                            App.ict_Error("Error en llave de acceso para actualizar tasa de cambio");
                            break;
                        case "ErrorDB":
                            App.ict_Error("Error actualizando tasa de cambio: DB");
                            break;
                        default:
                            App.ict_Error("Error de comunicación con el servidor");
                    }
                });
            }
        };
        self.initControls = function () {
            $('#slider').nivoSlider({controlNav: false});
        };
        self.initControls();
    }
    $(document).ready(function () {
        ko.applyBindings(new vmChangeRate());
    });
</script>
</body>
</html>