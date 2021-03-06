<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 6/13/2017
 * Time: 10:54 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>InCuba Travel by Grupo Gira S.A.</title>
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
                        <p style="font-size:11pt;font-family:Arial,sans-serif;color:#444444; margin:3px;">
                            Estimado Cliente <b><?= $Payment->first_name . ' ' . $Payment->last_name ?></b><br><br>
                            La reserva de auto ha sido confirmada por nuestros operadores, ahora puede usted
                            realizar el pago del servicio utilizando el siguiente hiperv&iacute;nculo.<br>
                            <br/>
                            Usted tiene 24 horas para realizar el pago por la reserva confirmada.
                            Si en este t&eacute;rmino no se realiza el pago autom&aacute;ticamente su reserva ser&aacute;
                            cancelada.
                            <br/><br/>
                        <div style="padding:15px;margin-bottom:20px;border:1px solid #d6e9c6;border-radius:4px;color:#3c763d;background-color:#dff0d8;">
                            <a href="<?= $redirect ?>">
                                <?= $this->lang->line('reservationnumber') . 'ICT' . $Payment->ict_payid ?>
                            </a>
                        </div>
                        <br><br>
                        Saludos<br/>
                        InCuba Travel by Grupo Gira S.A.<br/>
                        </p>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>