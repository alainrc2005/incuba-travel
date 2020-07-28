<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 4/4/2017
 * Time: 5:51 AM
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
    <title>InCubaTravel - Hotels</title>
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
            <div class="hr-title"><?= $this->lang->line('pic_hotels') ?></div>
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group" style="margin-top: 18px">
                        <?php foreach ($Cities as $pos => $city): ?>
                            <li data-city="<?= $city->Place ?>" role="button" class="list-group-item list-group-item-info <?= ($pos === 0 ? 'active' : '') ?>"><?= $city->Place ?>
                                <span class="badge badge-ict2"><?= $city->Cnt ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-md-9">
                    <table class="table table-responsive" style="border-collapse: separate;border-spacing: 0 18px;"
                           data-bind="foreach: hotels">
                        <tr style="background: #fff">
                            <td style="width: 35%">
                                <div class="mt-element-ribbon">
                                    <!-- ko if: Special==='1' -->
                                    <div class="ribbon ribbon-border-dash-hor ribbon-clip ribbon-color-default">
                                        <div class="ribbon-sub ribbon-clip"></div> <?= $this->lang->line('specialoffer') ?>
                                    </div>
                                    <!-- /ko -->
                                    <!-- ko if: IsNew==='1' -->
                                    <div class="ribbon ribbon-border-dash-hor ribbon-clip ribbon-color-primary">
                                        <div class="ribbon-sub ribbon-clip"></div> <?= $this->lang->line('isnew') ?>
                                    </div>
                                    <!-- /ko -->
                                </div>
                                <img class="img-thumbnail"
                                     data-bind="attr: {src: '<?= base_url('assets/img/hotels') ?>/'+Id+'/front.jpg?v=2'}"
                                     alt="InCuba Travel"/>
                            </td>
                            <td style="width: 50%">
                                <h4 data-bind="text: Name"></h4>
                                <div class="xtrunc" data-bind="html: Description"></div>
                            </td>
                            <td class="text-center" style="position: relative; width: 15%">
                                <div style="display: inline-block; height: 16px"
                                     class="stars" data-bind="style: {width: 16*Stars+'px'}"></div>
                                <br><strong class="text-uppercase" data-bind="text: Place"></strong>
                                <br>
                                <div class="pricenumber" data-bind="tomoney: FromPrice, Currency: $root.currency, Rate: $root.rate"></div>
                                <br>
                                <a data-bind="attr: {href: '<?= base_url('CartHotel') ?>/'+Id}"
                                   class="btn btn-default btn-book btn-position"><?= $this->lang->line('book') ?></a>
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

    function vmHotels() {
        var self = this;
        App.initCart(self, "<?=base_url('Api/dCart')?>", "<?=base_url('Checkout')?>");
        App.setCart(<?= $this->ictcart->getItemsJSON() ?>,<?= $this->ictcart->Length() ?>,<?= $this->ictcart->Total() ?>, "<?=$this->session->userdata('currency')?>",<?=$this->session->userdata('rate')?>);
        self.hotels = ko.observableArray();
        self.city = ko.observable("<?=$Cities[0]->Place?>");
        //self.city = ko.observable("Varadero");
        self.loadHotels = function () {
            App.ACmd({
                url: "<?=base_url('frontend/Home/getAllHotelsByCity')?>",
                data: {City: self.city()}
            },"json").done(function (r) {
                self.hotels(r);
                App.Truncate($(".xtrunc"), 180);
                $("table").fadeTo(1400,1);
            });
        };
        self.initControls = function () {
            $("#slider").nivoSlider({controlNav: false});
            $("li.list-group-item").on("click", function(evt){
                var el = this;
                $("table").fadeTo(1400,0.2,function(){
                    self.city(evt.target.dataset["city"]);
                    self.loadHotels();
                    $("li.list-group-item").removeClass("active");
                    $(el).addClass("active");
                });
            });
            self.loadHotels();
        };
        self.initControls();
    }

    $(document).ready(function () {
        ko.applyBindings(new vmHotels());
    });
</script>
</body>
</html>