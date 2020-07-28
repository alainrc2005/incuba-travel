<?php

/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 5/10/2017
 * Time: 9:44 PM
 */
class ICTPdf
{
    private $dompdf;

    function __construct() {
        log_message('debug', "ICTPdf Class Initialized");
        $this->dompdf = new \Dompdf\Dompdf();
        $this->dompdf->setPaper('a4', 'portrait');
    }

    public function load_htmlview($renderview) {
        $this->dompdf->loadHtml($renderview);
        $this->dompdf->render();
        return $this->dompdf->output();
    }
}