<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 6/22/2017
 * Time: 5:20 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>InCuba Travel by Grupo Gira S.A. - Error de Confirmando al Cliente</title>
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
                <div style="border:solid #FF0000 1px; padding: 5px;">
                    <div style="margin:5px 0;">
                        <div>
                            <p style="font-size:11pt;font-family:Arial,sans-serif;color:#444444; margin:3px;">
                                Ha ocurrido un error de acceso a datos confirmando el pago del cliente. Por favor, confirme manualmente la solicitud de pago <a href="<?=base_url('ManualConfirmation').'/'.$ict_payid?>">AQUI&Iacute;</a> o caso contrario el cliente no podr&aacute; generar Voucher.
                                <br><br>Saludos<br/>
                            InCuba Travel Web Site<br/>
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