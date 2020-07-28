<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 4/27/2017
 * Time: 10:45 PM
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
    <title>InCubaTravel</title>
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.gif"/>
    <link href="<?= base_url() ?>assets/css/incubatravel.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <div class="container">
        <div class="col-sm-12 col-md-5">
            <a title="In Cuba Travel" href="#" class="img-responsive animated fadeIn">
                <img class="pull-left" src="<?= base_url() ?>assets/img/logo.png">
            </a>
        </div>
        <div class="col-sm-12 col-md-7">
            <nav class="navbar navbar-default navbar-static-top animated fadeIn" role="navigation" id="menu">
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
            <div class="hr-title"><?= $Excursion->Name ?></div>
            <div class="row">
                <div id="thumbnail-slider">
                    <div class="inner">
                        <ul>
                            <?php foreach (shuffle_img(1, $Excursion->Images) as $i): ?>
                                <li><a class="thumb"
                                       href="<?= base_url('assets/img/excursions/' . $Excursion->Id . '/' . $i . '.jpg') ?>"></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <br>
            </div>
            <div class="hr-title"><?= $this->lang->line('itinerary') ?></div>
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <?= $Excursion->Itinerary ?>
                </div>
            </div>
            <div class="hr-title"><?= $this->lang->line('exc_opts') ?></div>
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
                    <table class="table table-responsive">
                        <tr>
                            <td class="middle" style="width: 30%">
                                <ul class="icon">
                                    <li> Min. PAX: <span
                                                class="badge badge-ict2"><?= $Excursion->MinPax ?></span></li>
                                    <li> <?= $this->lang->line('exc_departuretime') ?>: <span
                                                class="badge badge-ict2"><?= $Excursion->Departure ?></span></li>
                                    <li> <?= $this->lang->line('exc_duration') ?>: <span
                                                class="badge badge-ict2"><?= $Excursion->Duration ?></span></li>
                                    <li> <?= $this->lang->line('exc_frequency') ?>: <span
                                                class="badge badge-ict2"><?= $Excursion->Frequency ?></span></li>
                                    <li> <?= $this->lang->line('adultprice') ?>: <span
                                                class="badge badge-ict2"><?= priceFormat($Excursion->AdultsPrice) ?></span>
                                    </li>
                                    <li> <?= $this->lang->line('childrenprice') ?>: <span
                                                class="badge badge-ict2"><?= priceFormat($Excursion->ChildrenPrice) ?></span>
                                    </li>
                                </ul>
                            </td>
                            <td style="width: 50%">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label for="startdate"
                                               class="col-md-3 control-label"><?= $this->lang->line('date') ?></label>
                                        <div class="col-md-9">
                                            <input id="startdate" class="form-control"
                                                   data-bind="datepicker: startdate, pickerOptions:{startDate: new Date().toISOString(),language:'<?= $this->session->userdata('lang') ?>'}"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pickin"
                                               class="col-md-3 control-label"><?= $this->lang->line('car_pickin') ?></label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="pickin">
                                                <?php foreach ($Pickup as $pick): ?>
                                                    <option><?= $pick->Name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><?= $this->lang->line('adults') ?></label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="adults">
                                                <?php for ($i = 1; $i < 21; $i++): ?>
                                                    <option><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><?= $this->lang->line('children') ?></label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="children">
                                                <option>0</option>
                                                <?php for ($i = 1; $i < 21; $i++): ?>
                                                    <option><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center middle" style="width: 20%">
                                <button class="btn btn-default btn-book"
                                        data-bind="click: addtocart, enable: startdate.isValid()"><?= $this->lang->line('book') ?>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php $this->load->view('frontend/footer'); ?>
<script type="text/javascript" src="<?= base_url() ?>assets/js/incubatravel.min.js"></script>
<script type="text/javascript">
    function vmCartExcursion() {
        var self = this;
        App.initCart(self, "<?=base_url('Api/dCart')?>", "<?=base_url('Checkout')?>");
        App.setCart(<?= $this->ictcart->getItemsJSON() ?>,<?= $this->ictcart->Length() ?>,<?= $this->ictcart->Total() ?>, "<?=$this->session->userdata('currency')?>",<?=$this->session->userdata('rate')?>);
        self.startdate = ko.observable().extend({required: true});
        self.addtocart = function (data, evt) {
            var adults = parseInt($("#adults")[0].value),
                children = parseInt($("#children")[0].value);
            var price = App.getEPrice(<?=$Excursion->AdultsPrice?>, <?=$Excursion->ChildrenPrice?>, adults, children,<?=$Excursion->MinPax?>);
            if (price < 0) {
                App.ict_Error("<?=$this->lang->line('validchoise')?>");
                return;
            }
            self.sendcart(price, adults, children);
        };
        self.sendcart = function (price, adults, children) {
            var id = Date.now();
            App.ACmd({
                url: "<?=base_url('Api/addExcursion')?>",
                data: {
                    Id: id, ExcursionId: <?=$Excursion->Id?>, StartDate: self.startdate(), EndDate: self.startdate(),
                    Name: "<?=$Excursion->Name?>", Price: price, Adults: adults, Children: children, Pickin: $("#pickin")[0].value
                }
            }, "json").done(function (data) {
                self.kocart.push({Id: id, Type: "excursions", Name: "<?=$Excursion->Name?>", Price: price});
                self.kocartlength(data.length);
                self.kocarttotal(data.total);
                App.ict_Info("<?=$this->lang->line('addedtocart')?>");
            });
        };
        self.initControls = function () {
            $('#slider').nivoSlider({controlNav: false});
        };
        self.initControls();
    }
    $(document).ready(function () {
        ko.applyBindings(new vmCartExcursion());
    });
</script>
</body>
</html>