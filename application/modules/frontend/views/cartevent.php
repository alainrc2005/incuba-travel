<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 8/11/2017
 * Time: 8:04 PM
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
            <div class="hr-title"><?= $Event->Name ?></div>
            <div class="row">
                <div class="col-md-offset-1 col-md-3">
                    <img class="img-responsive img-rounded"
                         src="<?= base_url('assets/img/events/' . $Event->Id) ?>.jpg"/>
                </div>
                <div class="col-md-offset-1 col-md-6">
                    <br><br>
                    <span class="pricenumber"><?= $this->lang->line('packstartdate') ?> </span><input type="text"
                                                                                                      class="form-control"
                                                                                                      id="startdate"
                                                                                                      data-bind="datepicker: startdate, pickerOptions:{startView: 'decade', startDate: '<?=$Event->StartReservation?>', endDate:'<?=$Event->EndReservation?>',language:'<?= $this->session->userdata('lang') ?>'}"/>
                </div>
            </div>
            <div class="hr-title"><?= $this->lang->line('evt_include') ?></div>
            <div class="row">
                <div class="col-md-offset-1 col-md-11">
                    <?= $Event->Include ?>
                </div>
            </div>
            <div class="hr-title"><?= $this->lang->line('pkg_selecthotel') ?> <span class="badge badge-ict"
                                                                                    data-bind="text: startdate"></span>
            </div>
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <table class="table table-responsive">
                        <?php foreach ($Hotels as $row): ?>
                            <tr>
                                <td class="middle" style="width: 5%"><input type="radio" class="hotel radio"
                                                                            id="h_<?= $row->Id ?>"
                                                                            data-select="<?= $row->Id ?>" data-hotel="<?=$row->Name?>"
                                                                            name="rhotel" value="<?= $row->Id ?>"/></td>
                                <td class="middle" style="width: 35%"><img class="img-responsive img-rounded"
                                                                           src="<?= base_url('assets/img/events/hotels') ?>/<?= $row->Picture ?>"/>
                                </td>
                                <td class="middle" style="width: 35%">
                                    <?= $row->Name ?>
                                    <div style="width: <?= 16 * $row->Stars ?>px; height: 16px" class="stars"></div>
                                </td>
                                <td class="middle" style="width: 25%">
                                    <select class="category form-control" data-hotel="<?= $row->Id ?>"
                                            id="s_<?= $row->Id ?>">
                                        <?php foreach ($Categories as $category): ?>
                                            <option value="<?= $category->Id ?>"><?= $category->Category ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
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
                                     data-bind="attr: {src: '<?= base_url('assets/img/events/hotels') ?>/'+HotelId+'/'+Picture}"/>
                            </td>
                            <td class="middle" style="width: 25%">
                                <span data-bind="text: Name"></span><br>
                                <div class="pricenumber" data-bind="tomoney: window['rp'+Id], Currency: $parent.currency, Rate: $parent.rate"></div>
                            </td>
                            <td class="text-center middle" style="width: 35%">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><?= $this->lang->line('stay') ?></label>
                                        <div class="col-md-5">
                                            <select class="form-control"
                                                    data-bind="attr:{id: 'stay_'+Id}, options: $root.getStay(Id), optionsText: 'Stay', optionsValue: 'Price', value: window['rp'+Id]">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="middle" style="width: 15%">
                                <button class="btn btn-default btn-book"
                                        data-bind="click: $root.addtocart, attr:{ 'data-idx':Id}, enable: $root.validStartDate()"><?= $this->lang->line('book') ?>
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
    var prices = <?=json_encode($Prices)?>,
        rooms = <?=json_encode($Rooms)?>;

    function vmCartEvent() {
        var self = this;
        App.initCart(self, "<?=base_url('Api/dCart')?>", "<?=base_url('Checkout')?>");
        App.setCart(<?= $this->ictcart->getItemsJSON() ?>,<?= $this->ictcart->Length() ?>,<?= $this->ictcart->Total() ?>, "<?=$this->session->userdata('currency')?>",<?=$this->session->userdata('rate')?>);
        self.startdate = ko.observable().extend({required:true});
        self.enddate = ko.observable();
        self.rooms = ko.observableArray();
        self.hotelName = "";
        self.categoryName = "";
        self.validStartDate = ko.pureComputed(function(){
            return moment(self.startdate(),"YYYY-MM-DD").isValid();
        });
        self.getHotelRooms = function (hotelid, categoryid) {
            var ro=ko.utils.arrayFilter(rooms, function (room) {
                return room.HotelId === hotelid && categoryid === room.CategoryId;
            });
            ko.utils.arrayForEach(ro,function(rp){
               window["rp"+rp.Id]=ko.observable(0);
            });
            return ro;
        };
        self.getStay = function (roomid) {
            return ko.utils.arrayFilter(prices, function (price) {
                return price.RoomId === roomid;
            });
        };
        self.sendcart = function (room, price, stay) {
            var id = Date.now(), name = "<?=$Event->Name?> / {0} / {1} / {2}".sprintf(self.categoryName, self.hotelName,room.Name);
            App.ACmd({
                url: "<?=base_url('Api/addEventHotelRoom')?>",
                data: {
                    Id: id, EventId: room.EventId, HotelId: room.HotelId, RoomId: room.Id, CategoryId: room.CategoryId, StartDate: self.startdate(),
                    EndDate: self.enddate(), Name: name, Price: price, Stay: stay
                }
            }, "json").done(function (data) {
                self.kocart.push({Id: id, Type: "events", Name: name, Price: price});
                self.kocartlength(data.length);
                self.kocarttotal(data.total);
                App.ict_Info("<?=$this->lang->line('addedtocart')?>");
            });
        };
        self.addtocart = function (data, evt) {
            var stay = $("#stay_"+data.Id+" option:selected").text(),
            nights = stay.split("/")[1].replace("n","");
            self.enddate(moment(self.startdate(),"YYYY-MM-DD").add(nights,"days").format("YYYY-MM-DD"));
            var ds1 = App.getDates(self.startdate(),self.enddate()),
            ds2= App.getDates("<?=$Event->StartDate?>","<?=$Event->EndDate?>");
            if (App.getIntersection(ds1,ds2) < 2) {
                App.ict_Error("<?=$this->lang->line('validchoise')?>");
                return;
            }
            self.sendcart(data,window["rp"+data.Id](),stay);
        };
        self.getHotelData = function($el){
            self.hotelName = $("#h_"+$el).data("hotel");
            self.categoryName = $("#s_"+$el+" option:selected").text();
            self.rooms.removeAll();
            self.rooms(self.getHotelRooms($el, $("#s_" + $el)[0].value));
        };
        self.initControls = function () {
            $('#slider').nivoSlider({controlNav: false});
            $("input[type=radio].hotel").on("change", function (evt) {
                console.log("hotel change");
                var sel = evt.currentTarget.dataset["select"];
                self.getHotelData(sel);
            });
            $("select.category").on("change", function (evt) {
                console.log("category change");
                var sel = evt.currentTarget.dataset["hotel"];
                $("#h_" + sel).prop("checked", true);
                self.getHotelData(sel);
            });
        };
        self.initControls();
    }

    $(document).ready(function () {
        ko.applyBindings(new vmCartEvent());
    });
</script>
</body>
</html>