<?php
/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 4/17/2017
 * Time: 3:48 PM
 */
/**
 * Obtiene el IP de la dirección remota del cliente
 * @return mixed
 */
function getIpAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    else
        return $_SERVER['REMOTE_ADDR'];
}

function GetCityDetails() {
    $json = file_get_contents('http://getcitydetails.geobytes.com/GetCityDetails?fqcn=' . getIpAddress());
    return json_decode($json);
}

function ict_log_message($message) {
    static $_log;

    if ($_log === NULL) {
        // references cannot be directly assigned to static variables, so we use an array
        $_log[0] =& load_class('ICTLog');
    }

    $_log[0]->write_log($message);
}

function shuffle_img($start, $end) {
    $result = [];
    for ($i = $start; $i <= $end; $i++)
        $result[] = $i;
    shuffle($result);
    return $result;
}

function getVoucherType($invalue) {
    $result = [
        'hotels' => 'Hotel',
        'excursions' => 'Excursión',
        'roundtrips' => 'Circuito',
        'packs' => 'Paquete',
        'cars' => 'Auto',
        'events' => 'Evento'
    ];
    return $result[$invalue];
}

function priceFormat($price) {
    return number_format($price * $_SESSION['rate'], 2) . '<span>' . $_SESSION['currency'] . '<span></span>';
}