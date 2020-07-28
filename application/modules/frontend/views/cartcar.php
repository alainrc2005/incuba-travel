<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 4/27/2017
 * Time: 10:48 PM
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
    <br>
    <section>
        <div class="container">
            <div class="col-md-offset-2 col-md-8">
                <div class="alert alert-warning">
                    <?= $Explanation ?>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="hr-title"><?= $this->lang->line('customerdetails') ?></div>
            <div class="row">
                <form class="form-horizontal col-md-12">
                    <div class="form-group"
                         data-bind="css: App.validClass(customer.first_name)">
                        <label class="control-label col-md-5" for="firstname"><?= $this->lang->line('firstname') ?><span
                                    class="require"> *</span></label>
                        <div class="col-md-4">
                            <input type="text" id="firstname" class="form-control"
                                   data-bind="textInput: customer.first_name" autofocus/>
                        </div>
                    </div>
                    <div class="form-group"
                         data-bind="css: App.validClass(customer.last_name)">
                        <label class="control-label col-md-5" for="lastname"><?= $this->lang->line('lastname') ?><span
                                    class="require"> *</span></label>
                        <div class="col-md-4">
                            <input type="text" id="lastname" class="form-control"
                                   data-bind="textInput: customer.last_name"/>
                        </div>
                    </div>
                    <div class="form-group"
                         data-bind="css: App.validClass(customer.email)">
                        <label class="control-label col-md-5" for="email"><?= $this->lang->line('email') ?><span
                                    class="require"> *</span></label>
                        <div class="col-md-4">
                            <input type="text" id="email" class="form-control" data-bind="textInput: customer.email"/>
                        </div>
                    </div>
                    <div class="form-group"
                         data-bind="css: App.validClass(customer.phone)">
                        <label class="control-label col-md-5" for="phone"><?= $this->lang->line('phone') ?><span
                                    class="require"> *</span></label>
                        <div class="col-md-4">
                            <input type="text" id="phone" class="form-control" data-bind="textInput: customer.phone"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="hr-title"><?= $Category->Name ?></div>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <table class="table table-responsive">
                        <tr>
                            <td style="width: 75%">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label for="pickin"
                                               class="control-label col-md-5"><?= $this->lang->line('car_pickin') ?></label>
                                        <div class="col-md-6">
                                            <select id="pickin" class="form-control"
                                                    data-bind="value: reservation.Pickin">
                                                <?php foreach ($Locations as $row): ?>
                                                    <option><?= $row->Place ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"
                                         data-bind="css: App.validClass(reservation.StartDate)">
                                        <label for="startdate"
                                               class="control-label col-md-5"><?= $this->lang->line('car_start') ?></label>
                                        <div class="col-md-6">
                                            <input id="startdate" class="form-control"
                                                   data-bind="textInput: reservation.StartDate"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="dropoff"
                                               class="control-label col-md-5"><?= $this->lang->line('car_dropoff') ?></label>
                                        <div class="col-md-6">
                                            <select id="dropoff" class="form-control"
                                                    data-bind="value: reservation.Dropoff">
                                                <?php foreach ($Locations as $row): ?>
                                                    <option><?= $row->Place ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"
                                         data-bind="css: App.validClass(reservation.EndDate)">
                                        <label for="enddate"
                                               class="control-label col-md-5"><?= $this->lang->line('car_end') ?></label>
                                        <div class="col-md-6">
                                            <input id="enddate" class="form-control"
                                                   data-bind="datepicker: reservation.EndDate, pickerOptions:{startDate: new Date().toISOString(),language:'<?= $this->session->userdata('lang') ?>'}"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="trasmission"
                                               class="control-label col-md-5"><?= $this->lang->line('car_transmission') ?></label>
                                        <div class="col-md-6">
                                            <select class="form-control" data-bind="value: reservation.Transmission"
                                                    id="trasmission">
                                                <option value=".automatic"><?= $this->lang->line('car_automatic') ?></option>
                                                <option value=".manual"><?= $this->lang->line('car_manual') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" data-bind="css: App.validClass(customer.captcha)">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="Captcha"
                                                   data-bind="textInput: customer.captcha" style="height: 44px"/>
                                        </div>
                                        <img data-bind="attr: {src: captchasrc}"/>
                                        <span class="btn btn-info" data-bind="click: rCaptcha">
                            <i class="ion-ios-refresh-outline" style="font-size: 22px"></i></span>
                                    </div>
                                </div>
                            </td>
                            <td style="25%" class="text-center middle">
                                <div data-bind="visible: reservation.Price()!=-1">
                                    SUB TOTAL<br>
                                    <p class="pricenumber" data-bind="tomoney: reservation.Price, Currency: currency, Rate: rate"></p>
                                    <?= $this->lang->line('tbl_transaction') ?> 8%<br>
                                    <p class="pricenumber" data-bind="tomoney: reservation.Price()*0.08, Currency: currency, Rate: rate"></p>
                                    TOTAL<br>
                                    <p class="pricenumber" data-bind="tomoney: reservation.TotalPrice, Currency: currency, Rate: rate"></p>
                                    <br>
                                </div>
                                <button class="btn btn-default btn-book"
                                        data-bind="enable: ValidDates() && !c_errors().length && !r_errors().length, click: sendRequest"><?= $this->lang->line('book') ?></button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="hr-title"><?= $this->lang->line('car_models') ?></div>
            <div class="row mix-grid">
                <?php foreach ($Cars as $car): ?>
                    <div class="col-md-4 col-sm-4 mix <?= $car->Tag ?> text-center">
                        <img style="border-radius: 15px;" class="boxshadow"
                             src="<?= base_url('assets/img/cars') ?>/<?= $car->Picture ?>"/>
                        <p><?= $car->Name ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php $this->load->view('frontend/footer'); ?>
<script type="text/javascript" src="<?= base_url() ?>assets/js/incubatravel.min.js"></script>
<script type="text/javascript">
    function vmCartCar() {
        var self = this;
        App.initCart(self, "<?=base_url('Api/dCart')?>", "<?=base_url('Checkout')?>");
        App.setCart(<?= $this->ictcart->getItemsJSON() ?>,<?= $this->ictcart->Length() ?>,<?= $this->ictcart->Total() ?>,"<?=$this->session->userdata('currency')?>",<?=$this->session->userdata('rate')?>);
        self.customer = new App.cartModel();
        self.c_errors = ko.validation.group(self.customer);
        self.reservation = new App.carModel();
        self.reservation.CategoryId(<?=$Category->Id?>);
        self.r_errors = ko.validation.group(self.reservation);
        self.reservation.Transmission.subscribe(function (newValue) {
            $(".mix-grid").mixItUp("filter", self.reservation.Transmission());
            self.commonfn();
        });
        self.commonfn = function (newValue) {
            if (self.ValidDates()) self.getCarPriceById();
            else self.reservation.Price(-1);
        };
        self.reservation.StartDate.subscribe(self.commonfn);
        self.reservation.EndDate.subscribe(self.commonfn);
        self.getCarPriceById = function () {
            App.ACmd({
                url: "<?=base_url('Api/getCarPriceById')?>",
                data: ko.toJS(self.reservation)
            }, "json").done(function (price) {
                self.reservation.Price(price * (App.diffdays(self.reservation.StartDate(), self.reservation.EndDate()) - 1));
                self.reservation.TotalPrice(self.reservation.Price() * .08 + self.reservation.Price());
            });
        };
        self.ValidDates = function () {
            if (!self.reservation.StartDate() || !self.reservation.EndDate()) return false;
            var m1 = new moment(self.reservation.StartDate(), "YYYY-MM-DD HH:mm");
            if (!m1.isValid()) return false;
            var m2 = new moment(self.reservation.EndDate(), "YYYY-MM-DD");
            if (!m2.isValid()) return false;
            return m1 <= m2;
        };
        self.sendRequest = function () {
            App.ACmd({
                url: "<?=base_url('RequestCar')?>",
                data: {Customer: ko.toJS(self.customer), Reservation: ko.toJS(self.reservation)}
            }, "json").done(function (response) {
                switch (response.Code) {
                    case "NoCaptcha":
                        App.ict_Error("<?=$this->lang->line('chk_nocaptcha')?>");
                        break;
                    case "Ok":
                        App.ict_Info("<?=$this->lang->line('chk_success')?>");
                        setTimeout(function () {
                            window.location = "<?=base_url('Home')?>";
                        }, 5000);
                        break;
                    default:
                        App.ict_Error("<?=$this->lang->line('chk_error')?>");
                        break;
                }
            });
        };
        self.rCaptcha = function () {
            self.captchasrc("<?= base_url('GenCaptcha') ?>?rc=" + Date.now());
        };
        self.captchasrc = ko.observable("<?= base_url('GenCaptcha') ?>?rc=" + Date.now());
        self.initControls = function () {
            $('#slider').nivoSlider({controlNav: false});
            $("#startdate").datetimepicker({
                autoclose: true,
                format: "yyyy-mm-dd hh:ii",
                startDate: new Date(),
                language: '<?=$this->session->userdata('lang')?>'
            });
            $(".mix-grid").mixItUp();
        };
        self.initControls();
    }
    $(document).ready(function () {
        ko.applyBindings(new vmCartCar());
    });
</script>
</body>
</html>