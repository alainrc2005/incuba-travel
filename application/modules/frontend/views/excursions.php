<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 4/4/2017
 * Time: 6:03 AM
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
    <title>InCubaTravel - Excursions</title>
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
                            <a href="<?= base_url('Home') ?>"><i class="ion-home"></i> <?= $this->lang->line('mn_home') ?></a>
                        </li>
                        <li>
                            <a href="<?= base_url('Policies') ?>"><i class="ion-hammer"></i> <?= $this->lang->line('mn_policies') ?></a>
                        </li>
                        <li>
                            <a href="<?= base_url('ContactUs') ?>"><i class="ion-email"></i> <?= $this->lang->line('mn_contactus') ?></a>
                        </li>
                        <li>
                            <a href="<?= base_url('AboutUs') ?>"><i class="ion-android-people"></i> <?= $this->lang->line('mn_aboutus') ?></a>
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
            <div class="hr-title"><?=$this->lang->line('pic_excursions') ?></div>
            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-8">
                    <table class="table table-responsive" style="border-collapse: separate;border-spacing: 0 18px;">
                        <?php foreach ($Excursions as $row): ?>
                            <tr style="background: #fff">
                                <td style="width: 35%">
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
                                    <img class="img-thumbnail" width="200" src="<?= base_url('assets/img/excursions') ?>/<?= $row->Id ?>/front.jpg" alt=""/>
                                </td>
                                <td class="middle" style="width: 50%">
                                    <h2><?= $row->Name ?></h2><br>
                                </td>
                                <td class="text-center" style="position: relative; width: 15%">
                                    <?=$this->lang->line('adults')?>
                                    <br><div class="pricenumber"><?= priceFormat($row->AdultsPrice) ?></div>
                                    <?=$this->lang->line('children')?>
                                    <br><div class="pricenumber"><?= priceFormat($row->ChildrenPrice) ?></div><br>
                                    <a href="<?= base_url('CartExcursion') ?>/<?= $row->Id ?>" class="btn btn-default btn-book btn-position"><?=$this->lang->line('book')?></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php $this->load->view('frontend/footer'); ?>
<script type="text/javascript" src="<?= base_url() ?>assets/js/incubatravel.min.js"></script>
<script type="text/javascript">
    function vmExcursions() {
        var self = this;
        App.initCart(self, "<?=base_url('Api/dCart')?>", "<?=base_url('Checkout')?>");
        App.setCart(<?= $this->ictcart->getItemsJSON() ?>,<?= $this->ictcart->Length() ?>,<?= $this->ictcart->Total() ?>);
        self.initControls = function () {
            $('#slider').nivoSlider({controlNav: false});
        };
        self.initControls();
    }
    $(document).ready(function () {
        ko.applyBindings(new vmExcursions());
    });
</script>
</body>
</html>