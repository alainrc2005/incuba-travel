<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 5/29/2017
 * Time: 10:24 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>InCuba Travel by Grupo Gira S.A. - Vouchers</title>
</head>
<body>
<div style="position: absolute; width: 440px; top: 50%;    left: 50%;    transform: translateX(-50%)    translateY(-50%);">
    <table border="0" cellpadding="0" width="100%">
        <tr>
            <td style="background:#00A7C3; padding:5px; width:100%;text-align: center">
                <p>
                    <span style="font-family:Tahoma,sans-serif;color:#fff;">InCuba Travel by Grupo Gira S.A.</span>
                </p>
            </td>
        </tr>
        <tr>
            <td width="100%" style="width:100%;">
                <div style="border:solid #00A7C3 1px; padding: 5px;">
                    <div style="margin:5px 0;">
                        <div>
                            <p style="font-size:11pt;font-family:Arial,sans-serif;color:#444444; margin:3px;">
                            <p><?=$PaymentSuccess?></p>
                            <p style="color: #3c763d;  background-color: #dff0d8;  border-color: #d6e9c6;">
                                <a href="<?= base_url('Vouchers') . '/' . $ict_payid ?>"><?= $this->lang->line('reservationnumber') . 'ICT' . $ict_payid ?></a>
                            </p>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>