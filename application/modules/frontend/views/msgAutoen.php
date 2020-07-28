<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 6/11/2017
 * Time: 7:23 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>InCuba Travel by Grupo Gira S.A. - Automatic Answer</title>
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
                                Dear Customer<br><br>
                                Thank you for contacting InCubaTravel, we have received your "CAR RENTAL" request and within a maximum of 48h, you will get an answer to your request.<br>
                                If you require an urgent response, please do not hesitate to contact us by phone at this number <a href="tel:+5378384667" target="_blank">(+53)
                                    78384667</a><br/>
                                <br/>
                            <div style="padding:15px;margin-bottom:20px;border:1px solid #d6e9c6;border-radius:4px;color:#3c763d;background-color:#dff0d8;">
                                <?= $this->lang->line('reservationnumber') . 'ICT' . $ict_payid ?></div>
                            <br><br>
                            Best regards<br/>
                            InCuba Travel by Grupo Gira S.A.<br/>
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