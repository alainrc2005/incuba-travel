<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 7/5/2017
 * Time: 11:30 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>InCubaTravel - Hotels</title>
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.gif"/>
    <link href="<?= base_url() ?>assets/css/incubatravel.min.css" rel="stylesheet" type="text/css">
    <style>
        .calendar {
            width: 100%;
        }

        .calendar, .calendar table {
            border: 0;
            margin: 0;
        }

        .calendar, .calendar table, .calendar td {
            text-align: center;
        }

        .calendar .year {
            font-family: Verdana;
            font-size: 18pt;
            color: #ff9900;
        }

        .calendar .month {
            width: 25%;
            vertical-align: top;
        }

        .calendar .month table {
            font-size: 12pt;
            font-family: Verdana;
        }

        .calendar .month th {
            text-align: center;
            font-size: 12pt;
            font-family: Arial;
            color: #666699;
        }

        .calendar .month td {
            font-size: 12pt;
            font-family: Verdana;
        }

        .calendar .month .days td {
            color: #666666;
            font-weight: bold;
        }

        .calendar .month .sat {
            color: #0000cc;
        }

        .calendar .month .sun {
            color: #cc0000;
        }

        .calendar .month .today {
            background: #ffff00;
            color: #4040a1;
            border-radius: 50%;
        }
    </style>
</head>
<body>
<main>
    <section>
        <div class="container">
            <div class="hr-title">Calendario del Hotel: <?=$hotelName?></div>
            <div class="row">
                <?php foreach ($rooms as $key=>$value):?>
                <?= $value ?>
                <?php endforeach;?>
            </div>
        </div>
    </section>
</main>
<script type="text/javascript" src="<?= base_url() ?>assets/js/incubatravel.min.js"></script>
<script type="text/javascript">

    function vmCalendar() {
        var self = this;

    }

    $(document).ready(function () {
        ko.applyBindings(new vmCalendar());
    });
</script>
</body>
</html>