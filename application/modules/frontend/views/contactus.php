<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 4/4/2017
 * Time: 5:49 AM
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
    <title>InCubaTravel - Contact Us</title>
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
                        <li class="active">
                            <a href="javascript:;"><i class="ion-email"></i> <?= $this->lang->line('mn_contactus') ?>
                            </a>
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
    <section id="contactus">
        <div id="incubatravelmap" style="height: 320px; width: 100%;"></div>
        <br>
        <div class="container">
            <div class="hr-title"></div>
            <div class="row">
                <form novalidate>
                    <ul>
                        <li class="col-md-4">
                            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="ion-person"></i>
                        </span>
                                <input type="text" class="form-control"
                                       placeholder="<?= $this->lang->line('con_name') ?>"
                                       data-bind="textInput: contact.Name"/>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="ion-android-mail"></i>
                        </span>
                                <input type="text" class="form-control"
                                       placeholder="<?= $this->lang->line('con_email') ?>"
                                       data-bind="textInput: contact.Email"/>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="ion-ios-telephone"></i>
                        </span>
                                <input type="text" class="form-control"
                                       placeholder="<?= $this->lang->line('con_phone') ?>"
                                       data-bind="textInput: contact.Phone"/>
                            </div>
                        </li>
                        <li class="col-md-12">
                            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="ion-document-text"></i>
                        </span>
                                <textarea class="form-control" placeholder="<?= $this->lang->line('con_msg') ?>"
                                          rows="8"
                                          data-bind="textInput: contact.Message"></textarea>
                            </div>
                        </li>
                        <li style="float: left;margin-left: 16px;">
                            <div class="form-inline">
                                <input type="text" class="form-control" placeholder="Captcha"
                                       data-bind="textInput: contact.Captcha"/>
                                <img data-bind="attr: {src: captchasrc}"/>
                                <span class="btn btn-info" data-bind="click: rCaptcha">
                            <i class="ion-ios-refresh-outline" style="font-size: 22px"></i></span>
                            </div>
                        </li>
                        <li style="float: right;margin-right: 16px;">
                            <button class="btn btn-info" data-bind="enable: !errors().length, click: SendContact"><i
                                        class="ion-email"></i>
                                <?= $this->lang->line('con_send') ?>
                            </button>
                        </li>
                    </ul>
                </form>
            </div>
            <br><br>
        </div>
    </section>
</main>
<?php $this->load->view('frontend/footer'); ?>
<script type="text/javascript" src="<?= base_url() ?>assets/js/incubatravel.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFuUZ4zWSmHF-29svuMYJ5naXhXJkWm5g"></script>
<script type="text/javascript">

    function vmContact() {
        var self = this;
        App.initCart(self, "<?=base_url('Api/dCart')?>", "<?=base_url('Checkout')?>");
        App.setCart(<?= $this->ictcart->getItemsJSON() ?>,<?= $this->ictcart->Length() ?>,<?= $this->ictcart->Total() ?>, "<?=$this->session->userdata('currency')?>",<?=$this->session->userdata('rate')?>);
        self.contact = new App.modelContact();
        self.errors = ko.validation.group(self.contact);
        self.captchasrc = ko.observable("<?= base_url('GenCaptcha') ?>?rc=" + Date.now());
        self.initGoogleMap = function () {
            try {
                var profile = new google.maps.LatLng(23.139943, -82.382582);
                var mapOptions = {
                    center: profile,
                    mapTypeControl: false,
                    zoom: 16,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map(document.getElementById("incubatravelmap"), mapOptions);
                var marker = new google.maps.Marker({
                    position: profile,
                    animation: google.maps.Animation.BOUNCE
                });
                marker.setMap(map);
            } catch (e) {
                console.log(e);
            }
        };
        self.SendContact = function () {
            App.ACmd({
                url: "<?= base_url('sendContact') ?>",
                data: ko.toJS(self.contact)
            }).done(function (response) {
                switch (response) {
                    case "NoCaptcha":
                        App.ict_Error("<?=$this->lang->line('con_nocaptcha')?>");
                        break;
                    case "Error":
                        App.ict_Error("<?=$this->lang->line('con_error')?>");
                        break;
                    default:
                        App.ict_Info("<?=$this->lang->line('con_success')?>");
                        setTimeout(function () {
                            window.location = "<?=base_url('Home')?>";
                        }, 3000);
                }
            });
        };
        self.rCaptcha = function () {
            self.captchasrc("<?= base_url('GenCaptcha') ?>?rc=" + Date.now());
        };
        self.initGoogleMap();
    }


    $(document).ready(function () {
        $('#slider').nivoSlider({controlNav: false});
        ko.applyBindings(new vmContact());
    });
</script>
</body>
</html>