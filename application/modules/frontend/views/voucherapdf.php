<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 6/13/2017
 * Time: 7:13 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>InCuba Travel by Grupo Gira S.A. - Voucher</title>
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

        .middle {
            display: table-cell;
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
                    <img src="assets/img/gira.jpg"/>
                </td>
                <td colspan="4" class="center middle">
                    <h2>VOUCHER</h2>
                    <b><?= getVoucherType($Item->Type) ?></b>
                    <h2>
                        <?= $Payment->ict_payid ?>
                    </h2>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <b>CLIENTE</b><br>
                    <?= $Payment->first_name . ' ' . $Payment->last_name ?>
                </td>
            </tr>
            <tr>
                <td colspan="3"><b>DESCRIPCIÓN DEL SERVICIO</b><br><?= $Item->Name ?></td>
                <td colspan="2" class="center middle"><b>FECHA Y HORA</b></td>
            </tr>
            <tr>
                <td colspan="3"><b>RECOGIDA</b><br><?= $Item->Pickin ?></td>
                <td class="center middle" colspan="2"><?= $Item->StartDate . ' ' . $Item->Time ?></td>
            </tr>
            <tr>
                <td colspan="3"><b>ENTREGA</b><br><?= $Item->Dropoff ?></td>
                <td class="center middle" colspan="2"><?= $Item->EndDate . ' ' . $Item->Time ?></td>
            </tr>
        </table>
        <table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <td rowspan="2" style="width: 50%">
                    <b>OBSERVACIONES</b>
                    <hr style="color:blue">
                    <?= $Payment->observations ?>
                </td>
                <td>
                    <b>EMITIDO POR</b><br>
                    <img style="padding-left: 20px" src="assets/img/name.png"/>
                </td>
            </tr>
            <tr>
                <td>
                    <b>FIRMA</b><br>
                    <img style="padding-left: 60px" src="assets/img/sign.png"/>
                </td>
            </tr>
        </table>
    </div>
<?php endforeach; ?>
</body>
</html>