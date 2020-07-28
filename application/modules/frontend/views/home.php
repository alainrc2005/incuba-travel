<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 3/30/2017
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
    <title>InCuba Travel</title>
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.gif"/>
    <link href="<?= base_url() ?>assets/css/incubatravel.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <a href="<?= base_url('Home') ?>" class="img-responsive animated fadeIn">
                    <img src="<?= base_url() ?>assets/img/logo.png" alt="InCuba Travel"/>
                </a>
            </div>
            <div class="col-sm-12 col-md-7">
                <?php $this->load->view('frontend/headerblocks'); ?>
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
                            <li class="active">
                                <a href="javascript:;"><i class="ion-home"></i> <?= $this->lang->line('mn_home') ?></a>
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
            </div>
        </div>
    </div>
</header>
<main>
    <section>
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <?php foreach ($Carousel as $row): ?>
                    <img src="<?= base_url('assets/img/carousel') ?>/<?= $row->Picture ?>" alt="InCuba Travel"
                         title="<?= $row->Description ?>"/>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php $this->load->view('frontend/picsection'); ?>
    <section>
        <div class="container">
            <div class="hr-title"><?= $this->lang->line('tophotels') ?></div>
            <div class="row">
                <div class="col-md-3">
                    <span class="hr-zone"><?= $this->lang->line('hotelslane') ?></span>
                </div>
                <?php foreach ($Hotels as $row): ?>
                    <div class="col-md-3 animated fadeInRight">
                        <div class="card">
                            <div class="mt-element-ribbon">
                                <?php if ($row->Special) { ?>
                                    <div class="ribbon ribbon-border-dash-hor ribbon-clip ribbon-color-default">
                                        <div class="ribbon-sub ribbon-clip"></div> <?= $this->lang->line('specialoffer') ?>
                                    </div>
                                <?php } ?>
                                <?php if ($row->IsNew) { ?>
                                    <div class="ribbon ribbon-border-dash-hor ribbon-clip ribbon-color-primary">
                                        <div class="ribbon-sub ribbon-clip"></div> <?= $this->lang->line('isnew') ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="header cardh100"
                                 style="background-image: url('<?= base_url("assets/img/hotels") ?>/<?= $row->Id ?>/front.jpg'); background-position: center center; background-size: cover;"></div>
                            <div class="content">
                                <h1 class="title"><?= $row->Name ?></h1>
                                <span style="position:absolute;top:2px;right:2px">
                                    <div style="width: <?= 16 * $row->Stars ?>px; height: 16px" class="stars"></div>
                                </span>
                                <div class="description"><?= $row->Description ?></div>
                            </div>
                            <div class="footer" style="background-color: #f8f8f8; border-radius: 0 0 6px 6px;">
                                <div class="content">
                                    <?= $this->lang->line('from') ?>
                                    <div class="price"><?= priceFormat($row->FromPrice) ?></div>
                                    <a href="<?= base_url('CartHotel') ?>/<?= $row->Id ?>"
                                       class="btn btn-default add2card"><?= $this->lang->line('book') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="hr-title"><?= $this->lang->line('toppacks') ?></div>
            <div class="row">
                <?php foreach ($Packs as $row): ?>
                    <div class="col-md-3 animated fadeInLeftBig">
                        <div class="card">
                            <div class="mt-element-ribbon">
                                <?php if ($row->Special) { ?>
                                    <div class="ribbon ribbon-border-dash-hor ribbon-clip ribbon-color-default">
                                        <div class="ribbon-sub ribbon-clip"></div> <?= $this->lang->line('specialoffer') ?>
                                    </div>
                                <?php } ?>
                                <?php if ($row->IsNew) { ?>
                                    <div class="ribbon ribbon-border-dash-hor ribbon-clip ribbon-color-primary">
                                        <div class="ribbon-sub ribbon-clip"></div> <?= $this->lang->line('isnew') ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="header cardh200"
                                 style="background-image: url('<?= base_url("assets/img/packs") ?>/<?= $row->Id ?>.jpg'); background-position: center center; background-size: cover;"></div>
                            <div class="content">
                                <h1 class="title"><?= $row->Name ?></h1>
                            </div>
                            <div class="footer" style="background-color: #f8f8f8; border-radius: 0 0 6px 6px;">
                                <div class="content">
                                    <?= $this->lang->line('from') ?>
                                    <div class="price"><?= priceFormat($row->FromPrice) ?></span></div>
                                    <a href="<?= base_url('CartPack') ?>/<?= $row->Id ?>"
                                       class="btn btn-default add2card"><?= $this->lang->line('book') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="col-md-3">
                    <span class="hr-zone"><?= $this->lang->line('packslane') ?></span>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="hr-title"><?= $this->lang->line('toproundtrips') ?></div>
            <div class="row">
                <div class="col-md-3">
                    <span class="hr-zone32"><?= $this->lang->line('roundtripslane') ?></span>
                </div>
                <?php foreach ($Roundtrips as $row): ?>
                    <div class="col-md-3 animated fadeInRight">
                        <div class="card">
                            <div class="mt-element-ribbon">
                                <?php if ($row->Special) { ?>
                                    <div class="ribbon ribbon-border-dash-hor ribbon-clip ribbon-color-default">
                                        <div class="ribbon-sub ribbon-clip"></div> <?= $this->lang->line('specialoffer') ?>
                                    </div>
                                <?php } ?>
                                <?php if ($row->IsNew) { ?>
                                    <div class="ribbon ribbon-border-dash-hor ribbon-clip ribbon-color-primary">
                                        <div class="ribbon-sub ribbon-clip"></div> <?= $this->lang->line('isnew') ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="header cardh200"
                                 style="background-image: url('<?= base_url("assets/img/roundtrips") ?>/<?= $row->Id ?>/front.jpg'); background-position: center center; background-size: cover;"></div>
                            <div class="content">
                                <h1 class="title"><?= $row->Name ?></h1>
                            </div>
                            <div class="footer" style="background-color: #f8f8f8; border-radius: 0 0 6px 6px;">
                                <div class="content">
                                    <?= $this->lang->line('from') ?>
                                    <div class="price"><?= priceFormat($row->FromPrice) ?></span></div>
                                    <a href="<?= base_url('CartRoundtrip') ?>/<?= $row->Id ?>"
                                       class="btn btn-default add2card"><?= $this->lang->line('book') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="hr-title"><?= $this->lang->line('topexcursions') ?></div>
            <div class="row">
                <?php foreach ($Excursions as $row): ?>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="mt-element-ribbon">
                                <?php if ($row->Special) { ?>
                                    <div class="ribbon ribbon-border-dash-hor ribbon-clip ribbon-color-default">
                                        <div class="ribbon-sub ribbon-clip"></div> <?= $this->lang->line('specialoffer') ?>
                                    </div>
                                <?php } ?>
                                <?php if ($row->IsNew) { ?>
                                    <div class="ribbon ribbon-border-dash-hor ribbon-clip ribbon-color-primary">
                                        <div class="ribbon-sub ribbon-clip"></div> <?= $this->lang->line('isnew') ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="header cardh180"
                                 style="background-image: url('<?= base_url("assets/img/excursions") ?>/<?= $row->Id ?>/front.jpg'); background-position: center center; background-size: cover;"></div>
                            <div class="content">
                                <h1 class="title"><?= $row->Name ?></h1>
                            </div>
                            <div class="footer" style="background-color: #f8f8f8; border-radius: 0 0 6px 6px;">
                                <div class="content">
                                    <?= $this->lang->line('from') ?>
                                    <div class="price"><?= priceFormat($row->AdultsPrice) ?></span></div>
                                    <a href="<?= base_url('CartExcursion') ?>/<?= $row->Id ?>"
                                       class="btn btn-default add2card"><?= $this->lang->line('book') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="col-md-3">
                    <span class="hr-zone32"><?= $this->lang->line('excursionslane') ?></span>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="hr-title"><?= $this->lang->line('topcars') ?></div>
            <div class="row">
                <div class="col-md-3">
                    <span class="hr-zone"><?= $this->lang->line('carslane') ?></span>
                </div>
                <?php foreach ($Cars as $row): ?>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="mt-element-ribbon">
                                <?php if ($row->Special) { ?>
                                    <div class="ribbon ribbon-border-dash-hor ribbon-clip ribbon-color-default">
                                        <div class="ribbon-sub ribbon-clip"></div> <?= $this->lang->line('specialoffer') ?>
                                    </div>
                                <?php } ?>
                                <?php if ($row->IsNew) { ?>
                                    <div class="ribbon ribbon-border-dash-hor ribbon-clip ribbon-color-primary">
                                        <div class="ribbon-sub ribbon-clip"></div> <?= $this->lang->line('isnew') ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="header cardh180"
                                 style="background-image: url('<?= base_url("assets/img/cars") ?>/<?= $row->Id ?>.jpg'); background-position: center center; background-size: cover;"></div>
                            <div class="content">
                                <h1 class="title"><?= $row->Name ?></h1>
                            </div>
                            <div class="footer" style="background-color: #f8f8f8; border-radius: 0 0 6px 6px;">
                                <div class="content">
                                    <?= $this->lang->line('from') ?>
                                    <div class="price"><?= priceFormat($row->FromPrice) ?></span></div>
                                    <a href="<?= base_url('CartCar') ?>/<?= $row->Id ?>"
                                       class="btn btn-default add2card"><?= $this->lang->line('book') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php $this->load->view('frontend/footer'); ?>
<script type="text/javascript" src="<?= base_url() ?>assets/js/incubatravel.min.js"></script>
<script type="text/javascript">
    function vmHome() {
        var self = this;
        App.initCart(self, "<?=base_url('Api/dCart')?>", "<?=base_url('Checkout')?>");
        App.setCart(<?= $this->ictcart->getItemsJSON() ?>,<?= $this->ictcart->Length() ?>,<?= $this->ictcart->Total() ?>, "<?=$this->session->userdata('currency')?>",<?=$this->session->userdata('rate')?>);
        self.initControls = function () {
            $('#slider').nivoSlider({controlNav: false});
            App.Truncate($(".description"), 110);
        };
        self.initControls();
    }

    $(document).ready(function () {
        ko.applyBindings(new vmHome());
    });
</script>
</body>
</html>