<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 5/29/2017
 * Time: 8:22 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>InCubaTravel by Grupo Gira S.A. - Vouchers</title>
    <style>
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 5px;
        }

        .table > thead > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > th,
        .table > tbody > tr > td,
        .table > tfoot > tr > th,
        .table > tfoot > tr > td {
            padding: 4px;
            line-height: 1.42857;
            vertical-align: top;
            border: 1px solid #0000ff;
        }

        .table > thead > tr > th {
            vertical-align: bottom;
            border-bottom: 2px solid #e7ecf1;
        }

        .center {
            text-align: center;
        }
        .middle{
            vertical-align: middle;
        }
    </style>
</head>
<body>
<?php foreach ($Items as $Item): ?>
    <div style="page-break-after: always;">
        <table class="table" cellspacing="0" cellpadding="0">
            <tr>
                <td class="center" style="width: 45%">
                    <img src="<?= base_url('assets/img/gira.jpg') ?>"/>
                </td>
                <td colspan="4" class="center middle">
                    <h2>VOUCHER</h2>
                    <b><?=getVoucherType($Item->Type)?></b>
                    <h2>
                        <?= $Payment->ict_payid ?>
                    </h2>
                </td>
            </tr>
            <tr>
                <td>
                    <b>CLIENTE</b><br>
                    <?= $Payment->first_name . ' ' . $Payment->last_name ?>
                </td>
                <td class="center">
                    <b>ADULTOS</b><br>
                    <?= $Item->Adults ?>
                </td>
                <td class="center">
                    <b>NIÑOS</b><br>
                    <?= $Item->Children ?>
                </td>
                <td class="center">
                    <b>INFANTES</b><br>
                    <?= $Item->Infants ?>
                </td>
                <td class="center">
                    <b>TOTAL</b><br>
                    <?= $Item->Adults + $Item->Infants + $Item->Children ?>
                </td>
            </tr>
            <tr>
                <td colspan="4"><b>DESCRIPCIÓN DEL SERVICIO</b></td>
                <td class="center"><b>FECHA</b></td>
            </tr>
            <tr>
                <td colspan="4" style="height: 100px"><?= $Item->Name ?></td>
                <td><?= $Item->StartDate ?><?= ($Item->Type === 'events') ? '<br>'.$Item->EndDate : '' ?></td>
            </tr>
        </table>
        <table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <td rowspan="2" style="width: 50%"><b>OBSERVACIONES</b><br>
                    <?= ($Item->Type === 'excursions') ? $Item->Pickin : '' ?>
                    <?= ($Item->Type === 'events') ? '<br>'.$Item->Stay : '' ?>
                </td>
                <td>
                    <b>EMITIDO POR</b><br>
                    <img style="padding-left: 20px" src="<?= base_url('assets/img/name.png') ?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <b>FIRMA</b><br>
                    <img style="padding-left: 60px" src="<?= base_url('assets/img/sign.png') ?>"/>
                </td>
            </tr>
        </table>
    </div>
<?php endforeach; ?>
</body>
</html>