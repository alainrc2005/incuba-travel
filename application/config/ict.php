<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 4/30/2017
 * Time: 9:13 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$config['azubapay_mode'] = 'Development';
$config['azubapay_url'] = $config['azubapay_mode']==='Development' ? 'https://dev.cubanboulevard.com' : 'https://www.cubanboulevard.com';
$config['azubapay_user'] = '********';
$config['azubapay_apikey'] = $config['azubapay_mode']==='Development' ? '********': '********';
$config['azubapay_notify'] = '1';
$config['azubapay_currency'] = 'EUR';
$config['azubapay_expire_days'] = '10';
$config['azubapay_cancelation_fee'] = '0';
$config['azubapay_description'] = 'ICT_WebSite';
$config['azubapay_paymentroute'] = '/seller/payment_request/CreatePaymentRequest';
$config['azubapay_loadtransaction'] = '/seller/transaction/load_transaction/';
$config['azubapay_modality'] = 'ecom';

$config['seller_email'] = '********';
