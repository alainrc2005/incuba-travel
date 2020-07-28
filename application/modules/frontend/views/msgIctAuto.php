<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 6/13/2017
 * Time: 6:56 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>InCuba Travel by Grupo Gira S.A. - Solicitud de Auto</title>
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
                            <p style="font-size:11pt;font-family:Arial,sans-serif;color:#444444; margin:3px;">Solicitud de Auto: <b><a href="<?=base_url('CarConfirmation').'/'.$reservation->CartGuid?>"><?=$reservation->CartGuid?></a></b><br><br>
                                Cliente: <b><?=$customer->first_name. ' '.$customer->last_name?></b><br>
                            Email: <b><?=$customer->email?></b><br>
                            Tel&eacute;fono: <b><?=$customer->phone?></b><br>
                            <hr>
                            Categor&iacute;a: <b><?=$reservation->Name?></b><br>
                            Recogida: <b><?=$reservation->Pickin?></b><br>
                            Fecha y Hora: <b><?=$reservation->StartDate.' '.$reservation->Time?></b><br>
                            <hr>
                            Entrega: <b><?=$reservation->Dropoff?></b><br>
                            Fecha y Hora: <b><?=$reservation->EndDate.' '.$reservation->Time?></b><br>
                            <hr>
                            Precio Diario: <b>$<?=number_format($reservation->Price,2,'.',',')?></b><br>
                            Precio Total: <b>$<?=number_format($reservation->TotalPrice,2,'.',',')?></b><br>
                            <br>Saludos<br/>
                            InCuba Travel Web Site<br/>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>