<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 4/23/2017
 * Time: 2:29 PM
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
            <div class="hr-title"><?= $Hotel->Name ?></div>
            <div class="row">
                <div id="thumbnail-slider">
                    <div class="inner">
                        <ul>
                            <?php foreach (shuffle_img(1, $Hotel->Images) as $i): ?>
                                <li><a class="thumb"
                                       href="<?= base_url('assets/img/hotels/' . $Hotel->Id . '/' . $i . '.jpg') ?>"></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <br>
                <div class="col-md-offset-1 col-md-10">
                    <p class="text-center"><?= $Hotel->Description ?></p>
                </div>
            </div>
            <div class="hr-title"><?= $this->lang->line('htl_dates') ?></div>
            <div class="row">
                <div class="col-md-offset-2 col-md-3">
                    <div class="form-group">
                        <label for="startdate" class="control-label"><?= $this->lang->line('htl_arrival') ?></label>
                        <input id="startdate" class="form-control"
                               data-bind="datepicker: startdate, pickerOptions:{startDate: new Date().toISOString(),language:'<?= $this->session->userdata('lang') ?>'}"/>
                    </div>
                </div>
                <div class="col-md-offset-2 col-md-3">
                    <div class="form-group">
                        <label for="enddate" class="control-label"><?= $this->lang->line('htl_departure') ?></label>
                        <input id="enddate" class="form-control"
                               data-bind="datepicker: enddate, pickerOptions:{startDate: new Date().toISOString(),language:'<?= $this->session->userdata('lang') ?>'}"/>
                    </div>
                </div>
            </div>
            <!-- ko if: rooms().length-->
            <div class="hr-title"><?= $this->lang->line('pkg_rooms') ?>
            </div>
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
                    <table class="table table-responsive" data-bind="foreach: rooms">
                        <tr>
                            <td class="middle" style="width: 25%">
                                <img class="img-responsive img-rounded"
                                     data-bind="attr: {src: '<?= base_url('assets/img/hotels') ?>/'+HotelId+'/r'+RankOrder+'.jpg'}"/>
                            </td>
                            <td class="middle" style="width: 25%">
                                <span data-bind="text: Name"></span><br>
                                <div class="pricenumber" data-bind="tomoney: Price, Currency: $parent.currency, Rate: $parent.rate"></div>
                            </td>
                            <td class="text-center middle" style="width: 35%">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><?= $this->lang->line('adults') ?></label>
                                        <div class="col-md-5">
                                            <select class="form-control"
                                                    data-bind="attr:{id: 'adults_'+$index()}, foreach: Adults.split(',')">
                                                <option data-bind="text: $data"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><?= $this->lang->line('children') ?>
                                            0--1.99</label>
                                        <div class="col-md-5">
                                            <select class="form-control"
                                                    data-bind="attr:{id: 'infants_'+$index()}, foreach: Infants.split(',')">
                                                <option data-bind="text: $data"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><?= $this->lang->line('children') ?>
                                            2--11.99</label>
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
                                        data-bind="click: $parent.addtocart, attr:{ 'data-idx':$index()}, enable: Price!==-1"><?= $this->lang->line('book') ?>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /ko -->
        </div>
    </section>
    <section id="smap">
        <div class="container">
            <div class="hr-title"><?= $Hotel->Name ?></div>
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div id="gmap" class="gmap-container" style="height: 358px;border: 1px solid #A3CCFF">

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php $this->load->view('frontend/footer'); ?>
<script type="text/javascript" src="<?= base_url() ?>assets/js/incubatravel.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFuUZ4zWSmHF-29svuMYJ5naXhXJkWm5g"></script>
<script type="text/javascript">
    function vmCartHotel() {
        var self = this;
        App.initCart(self, "<?=base_url('Api/dCart')?>", "<?=base_url('Checkout')?>");
        App.setCart(<?= $this->ictcart->getItemsJSON() ?>,<?= $this->ictcart->Length() ?>,<?= $this->ictcart->Total() ?>, "<?=$this->session->userdata('currency')?>",<?=$this->session->userdata('rate')?>);
        self.rooms = ko.observableArray();
        self.startdate = ko.observable();
        self.enddate = ko.observable();
        self.startdate.subscribe(function () {
            self.ValidDates();
        });
        self.enddate.subscribe(function () {
            self.ValidDates();
        });
        self.getHotelRooms = function (hotelid) {
            App.ACmd({
                url: "<?=base_url('Api/getHotelRoomById')?>",
                data: {HotelId: hotelid, StartDate: self.startdate(), EndDate: self.enddate()}
            }, "json").done(function (data) {
                self.rooms(data);
            });
        };
        self.ValidDates = function () {
            console.log("validdates");
            if (!self.startdate() || !self.enddate()) return false;
            var m1 = new moment(self.startdate(), "YYYY-MM-DD");
            if (!m1.isValid()) return false;
            var m2 = new moment(self.enddate(), "YYYY-MM-DD");
            if (!m2.isValid()) return false;
            if (m1 <= m2) {
                self.getHotelRooms(<?=$Hotel->Id?>);
                return true;
            }
            self.rooms.removeAll();
            return false;
        };
        self.addtocart = function (data, evt) {
            var idx = ($(evt.target).data("idx")),
                adults = parseInt($("#adults_" + idx)[0].value),
                infants = parseInt($("#infants_" + idx)[0].value),
                children = parseInt($("#children_" + idx)[0].value);
            var nights = App.diffdays(self.startdate(), self.enddate());
            if (nights !== 1) --nights;
            var price = parseFloat(data.Price);
            if (price < 0) {
                App.ict_Error("<?=$this->lang->line('validchoise')?>");
                return;
            }
            if (data.Method) price = eval("App.{0}({1},{2},{3},{4},{5});".sprintf(data.Method, price, adults, infants, children, nights));
            else {
                eval(data.CustomMethod);
                price = tf(parseFloat(data.Price), adults, infants, children, nights);
            }
            if (price < 0) {
                App.ict_Error("<?=$this->lang->line('validchoise')?>");
                return;
            }
            self.sendcart(<?=$Hotel->Id?>, data.Id, data.Name, price, adults, infants, children);
        };
        self.sendcart = function (hotelId, roomId, roomName, price, adults, infants, children) {
            var id = Date.now(), name = "<?=$Hotel->Name?> / {0}".sprintf(roomName);
            App.ACmd({
                url: "<?=base_url('Api/addHotelRoom')?>",
                data: {
                    Id: id, HotelId: hotelId, RoomId: roomId, StartDate: self.startdate(),
                    EndDate: self.enddate(), Name: name, Price: price, Adults: adults, Infants: infants,
                    Children: children
                }
            }, "json").done(function (data) {
                self.kocart.push({Id: id, Type: "hotels", Name: name, Price: price});
                self.kocartlength(data.length);
                self.kocarttotal(data.total);
                App.ict_Info("<?=$this->lang->line('addedtocart')?>");
            });
        };
        self.initGoogleMap = function () {
            try {
                var profile = new google.maps.LatLng(<?=$Hotel->Latitude?>, <?=$Hotel->Longitude?>);
                var mapOptions = {
                    center: profile,
                    mapTypeControl: false,
                    zoom: 16,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scrollwheel: false,
                    draggable: false,
                    panControl: false,
                    zoomControl: false,
                    mapTypeControl: false,
                    scaleControl: false,
                    streetViewControl: false,
                    overviewMapControl: true,
                    rotateControl: true
                };
                var map = new google.maps.Map(document.getElementById("gmap"), mapOptions);
            } catch (e) {
                console.log(e);
                $("#smap").hide();
            }
        };
        self.initControls = function () {
            $('#slider').nivoSlider({controlNav: false});
            self.initGoogleMap();
        };
        self.initControls();
    }
    $(document).ready(function () {
        ko.applyBindings(new vmCartHotel());
    });
</script>
</body>
</html>