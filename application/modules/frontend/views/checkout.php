<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 4/30/2017
 * Time: 8:50 PM
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
    <title>InCubaTravel - About Us</title>
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
                        <li class="active">
                            <a href="javascript:void(0);"><i
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
    <section>
        <div class="container">
            <div class="hr-title"><?= $this->lang->line('customerdetails') ?></div>
            <div class="row">
                <form class="form-horizontal col-md-12">
                    <div class="form-group" data-bind="css: App.validClass(customer.first_name)">
                        <label class="control-label col-md-5" for="firstname"><?= $this->lang->line('firstname') ?><span
                                    class="require"> *</span></label>
                        <div class="col-md-4">
                            <input type="text" id="firstname" class="form-control"
                                   data-bind="textInput: customer.first_name"/>
                        </div>
                    </div>
                    <div class="form-group" data-bind="css: App.validClass(customer.last_name)">
                        <label class="control-label col-md-5" for="lastname"><?= $this->lang->line('lastname') ?><span
                                    class="require"> *</span></label>
                        <div class="col-md-4">
                            <input type="text" id="lastname" class="form-control"
                                   data-bind="textInput: customer.last_name"/>
                        </div>
                    </div>
                    <div class="form-group" data-bind="css: App.validClass(customer.email)">
                        <label class="control-label col-md-5" for="email"><?= $this->lang->line('email') ?><span
                                    class="require"> *</span></label>
                        <div class="col-md-4">
                            <input type="text" id="email" class="form-control" data-bind="textInput: customer.email"/>
                        </div>
                    </div>
                    <div class="form-group" data-bind="css: App.validClass(customer.phone)">
                        <label class="control-label col-md-5" for="phone"><?= $this->lang->line('phone') ?><span
                                    class="require"> *</span></label>
                        <div class="col-md-4">
                            <input type="text" id="phone" class="form-control" data-bind="textInput: customer.phone"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="hr-title"><?= $this->lang->line('confirmorder') ?></div>
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th><?= $this->lang->line('tbl_type') ?></th>
                            <th class="text-center"><?= $this->lang->line('tbl_description') ?></th>
                            <th class="text-center"><?= $this->lang->line('tbl_from') ?></th>
                            <th class="text-center"><?= $this->lang->line('tbl_to') ?></th>
                            <th class="text-center"><?= $this->lang->line('tbl_price') ?></th>
                        </tr>
                        </thead>
                        <tbody data-bind="foreach: kocart">
                        <tr style="background: #fff">
                            <td>
                                <img class="img-rounded"
                                     data-bind="attr: {src: '<?= base_url() ?>/assets/img/options/'+Type+'.jpg'}"
                                     width="60">
                            </td>
                            <td class="middle" data-bind="text: Name">
                            </td>
                            <td class="middle text-center" data-bind="text: StartDate">
                            </td>
                            <td class="middle text-center" data-bind="text: EndDate">
                            </td>
                            <td class="middle text-right">
                                <span class="pricenumber" data-bind="tomoney: Price, Currency: $parent.currency, Rate: $parent.rate"></span>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr style="background: #e6e6e6">
                            <td colspan="4" class="middle text-right">SUB TOTAL</td>
                            <td class="text-right pricenumber" data-bind="tomoney: kocarttotal, Currency: currency, Rate: rate"></td>
                        </tr>
                        <tr style="background: #e2e2e2">
                            <td colspan="4" class="middle text-right"><?= $this->lang->line('tbl_transaction') ?> 8%
                            </td>
                            <td class="text-right pricenumber" data-bind="tomoney: kocarttotal()*0.08, Currency: currency, Rate: rate"></td>
                        </tr>
                        <tr style="background: #e9e9e9">
                            <td colspan="4" class="middle text-right">TOTAL</td>
                            <td class="text-right pricenumber"
                                data-bind="tomoney: (kocarttotal()*0.08+kocarttotal()), Currency: currency, Rate: rate"></td>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="form-inline" data-bind="css: App.validClass(customer.captcha)">
                        <input type="text" class="form-control" placeholder="Captcha"
                               data-bind="textInput: customer.captcha" style="height: 44px"/>
                        <img data-bind="attr: {src: captchasrc}"/>
                        <span class="btn btn-info" data-bind="click: rCaptcha">
                            <i class="ion-ios-refresh-outline" style="font-size: 22px"></i></span>
                        <div class="pull-right">
                            <button class="btn btn-default" style="height: 44px"
                                    data-bind="click: Cancel"><?= $this->lang->line('btn_cancel') ?></button>
                            <button class="btn btn-info" style="height: 44px"
                                    data-bind="enable: (!errors().length && kocart().length), click: Confirm"><?= $this->lang->line('btn_confirm') ?></button>
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

    function vmCheckout() {
        var self = this;
        App.initCart(self, "<?=base_url('Api/dCart')?>", "<?=base_url('Checkout')?>");
        App.setCart(<?= $this->ictcart->getItemsJSON() ?>,<?= $this->ictcart->Length() ?>,<?= $this->ictcart->Total() ?>, "<?=$this->session->userdata('currency')?>",<?=$this->session->userdata('rate')?>);
        self.customer = new App.cartModel();
        self.errors = ko.validation.group(self.customer);
        self.Cancel = function () {
            window.location = "<?=base_url('Home')?>";
        };
        self.rCaptcha = function () {
            self.captchasrc("<?= base_url('GenCaptcha') ?>?rc=" + Date.now());
        };
        self.captchasrc = ko.observable("<?= base_url('GenCaptcha') ?>?rc=" + Date.now());
        self.Confirm = function () {
            App.ACmd({
                url: "<?=base_url('Confirm')?>",
                data: {Customer: ko.toJS(self.customer), Total: self.kocarttotal()}
            }, "json").done(function (response) {
                switch (response.Code) {
                    case "NoCaptcha":
                        App.ict_Error("<?=$this->lang->line('chk_nocaptcha')?>");
                        break;
                    case "Ok":
                        App.ict_Info("<?=$this->lang->line('chk_success')?>");
                        setTimeout(function () {
                            window.location = response.Redirect;
                        }, 3000);
                        break;
                    default:
                        App.ict_Error("<?=$this->lang->line('chk_error')?>");
                        break;
                }
            });
        };
        self.initControls = function () {
            $('#slider').nivoSlider({controlNav: false});
        };
        self.initControls();
    }
    $(document).ready(function () {
        ko.applyBindings(new vmCheckout());
    });
</script>
</body>
</html>