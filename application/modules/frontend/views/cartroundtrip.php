<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 4/27/2017
 * Time: 10:42 PM
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
            <div class="hr-title"><?= $Roundtrip->Name ?></div>
            <div class="row">
                <div id="thumbnail-slider">
                    <div class="inner">
                        <ul>
                            <?php foreach (shuffle_img(1, $Roundtrip->Images) as $i): ?>
                                <li><a class="thumb"
                                       href="<?= base_url('assets/img/roundtrips/' . $Roundtrip->Id . '/' . $i . '.jpg') ?>"></a>
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
                    <?= $Roundtrip->Itinerary ?>
                </div>
            </div>
            <div class="hr-title"><?= $this->lang->line('exc_opts') ?></div>
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <div class="form-group">
                        <label for="startdate" class="control-label"><?= $this->lang->line('packstartdate') ?></label>
                        <input id="startdate" class="form-control"
                               data-bind="datepicker: startdate, pickerOptions:{startDate: new Date().toISOString(),language:'<?= $this->session->userdata('lang') ?>',beforeShowDay: function (d){return d.getDay()==<?= $Roundtrip->StartDay ?>;}}"/>
                    </div>
                </div>
            </div>
            <!-- ko if: rooms().length -->
            <div class="hr-title"><?= $this->lang->line('pkg_rooms') ?>
            </div>
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
                    <table class="table table-responsive" data-bind="foreach: rooms">
                        <tr>
                            <td class="middle" style="width: 25%">
                                <img class="img-responsive img-rounded"
                                     data-bind="attr: {src: '<?= base_url('assets/img/roundtrips') ?>/r'+RankOrder+'.jpg'}"/>
                            </td>
                            <td class="middle" style="width: 25%">
                                <span data-bind="text: Name"></span><br>
                                <div class="pricenumber" data-bind="tomoney: Price, Currency:$parent.currency, Rate: $parent.rate"></div>
                            </td>
                            <td class="text-center middle" style="width: 35%">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Adults</label>
                                        <div class="col-md-5">
                                            <select class="form-control"
                                                    data-bind="attr:{id: 'adults_'+$index()}, foreach: Adults.split(',')">
                                                <option data-bind="text: $data"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Children 0--1.99</label>
                                        <div class="col-md-5">
                                            <select class="form-control"
                                                    data-bind="attr:{id: 'infants_'+$index()}, foreach: Infants.split(',')">
                                                <option data-bind="text: $data"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Children 2--11.99</label>
                                        <div class="col-md-5">
                                            <select class="form-control"
                                                    data-bind="attr:{id: 'children_'+$index()}, foreach: Children.split(',')">
                                                <option data-bind="text: $data"></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="middle" style="width: 15%">
                                <button class="btn btn-default btn-book"
                                        data-bind="click: $parent.addtocart, attr:{ 'data-idx':$index()}"><?= $this->lang->line('book') ?>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /ko -->
        </div>
    </section>
</main>
<?php $this->load->view('frontend/footer'); ?>
<script type="text/javascript" src="<?= base_url() ?>assets/js/incubatravel.min.js"></script>
<script type="text/javascript">
    function vmCartRoundtrip() {
        var self = this;
        App.initCart(self, "<?=base_url('Api/dCart')?>", "<?=base_url('Checkout')?>");
        App.setCart(<?= $this->ictcart->getItemsJSON() ?>,<?= $this->ictcart->Length() ?>,<?= $this->ictcart->Total() ?>, "<?=$this->session->userdata('currency')?>", <?=$this->session->userdata('rate')?>);
        self.rooms = ko.observableArray();
        self.startdate = ko.observable();
        self.enddate = ko.observable();
        self.startdate.subscribe(function (newValue) {
            var mm = moment(newValue, "YYYY-MM-DD");
            if (!mm.isValid()) return;
            self.enddate(mm.add(<?=$Roundtrip->Days?>-1, "days").format("YYYY-MM-DD"));
            self.rooms.removeAll();
            self.getHotelRooms(<?=$Roundtrip->Id?>);
        });
        self.getHotelRooms = function (roundtripid) {
            App.ACmd({
                url: "<?=base_url('Api/getRoundtripRoomById')?>",
                data: {RoundtripId: roundtripid, StartDate: self.startdate(), EndDate: self.enddate()}
            }, "json").done(function (data) {
                self.rooms(data);
            });
        };
        self.addtocart = function (data, evt) {
            var idx = ($(evt.target).data("idx")),
                adults = parseInt($("#adults_" + idx)[0].value),
                infants = parseInt($("#infants_" + idx)[0].value),
                children = parseInt($("#children_" + idx)[0].value);
            var price = -1;
            if (data.Method) price = eval("App.{0}({1},{2},{3},{4});".sprintf(data.Method, parseFloat(data.Price), adults, infants, children));
            else {
                eval(data.CustomMethod);
                price = tf(parseFloat(data.Price), adults, infants, children);
            }
            if (price < 0) {
                App.ict_Error("<?=$this->lang->line('validchoise')?>");
                return;
            }
            self.sendcart(data.Id, data.Name, price, adults, infants, children);
        };
        self.sendcart = function (roomId, roomName, price, adults, infants, children) {
            var id = Date.now(), name = "<?=$Roundtrip->Name?> / {0}".sprintf(roomName);
            App.ACmd({
                url: "<?=base_url('Api/addRoundtrip')?>",
                data: {
                    Id: id, RoundtripId: <?= $Roundtrip->Id ?>, RoomId: roomId, StartDate: self.startdate(),
                    EndDate: self.enddate(), Name: name, Price: price, Adults: adults, Infants: infants,
                    Children: children
                }
            }, "json").done(function (data) {
                self.kocart.push({Id: id, Type: "roundtrips", Name: name, Price: price});
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
        ko.applyBindings(new vmCartRoundtrip());
    });
</script>
</body>
</html>