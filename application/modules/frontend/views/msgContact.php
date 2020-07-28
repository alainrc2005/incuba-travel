<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 4/17/2017
 * Time: 8:05 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Contact Information from Web Site</title>
</head>
<body>
<div style="position: absolute; width: 440px; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">
    <table border="0" cellpadding="0" style="width:630px;">
        <tbody>
        <tr>
            <td style="background:#00A7C3; padding: 5px; width:100%;text-align: center">
                <h2><span style="font-family:Tahoma,sans-serif;color:#fff;">Contact Information from Web Site</span></h2>
            </td>
        </tr>
        <tr>
            <td style="width:100%;">
                <div style="border:solid #00A7C3 1px; padding: 5px;">
                    <table>
                        <?php foreach ($lines as $key => $value): ?>
                            <tr>
                                <td style="width: 30%"><strong><span
                                                style="font-size:11pt;font-family:Arial,sans-serif;color:#444444"><?= $key ?></span></strong>
                                </td>
                                <td style="width: 70%"><span
                                            style="font-size:11pt;font-family:Arial,sans-serif;color:#444444; line-height: 150%;  text-align: justify;"><?= $value ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td style="background:#00A7C3; padding:5px;">
                <p style="text-align: center"><span style="font-family:Tahoma,sans-serif;color:#fff;">&copy; InCubaTravel by Grupo Gira S.A. - All right reserved</span>
                    <?= date("Y/m/d H:i") ?>
                </p>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>