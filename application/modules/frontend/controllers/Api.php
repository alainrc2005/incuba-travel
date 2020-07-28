<?php

/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 4/25/2017
 * Time: 4:55 AM
 */
class Api extends MX_Controller
{
    protected $lang;

    function __construct() {
        $this->lang = $this->session->userdata('lang');
    }

    public function captcha() {
        $this->load->library('captcha');
        $result = $this->captcha->generateCaptcha();
        $_SESSION['captcha'] = $result['code'];
        header("Content-type: image/png");
        imagepng($result['img']);
        echo $result['code'];
    }

    public function getHotelRoomById() {
        $hotelid = $this->input->post('HotelId');
        $startdate = $this->input->post('StartDate');
        $enddate = $this->input->post('EndDate');
        $rooms = $this->db->query("SELECT * FROM rooms$this->lang WHERE HotelId=?", $hotelid)->result();
        foreach ($rooms as $room) {
            $room->Price = -1;
            $row = $this->db->query("SELECT Price,Method,CustomMethod FROM rooms_prices WHERE HotelId=? AND RoomId=? AND ((FromDate<=? AND ToDate>=?) OR (FromDate<=? AND ToDate>=?)) ORDER BY Price DESC LIMIT 1", [$hotelid, $room->Id, $startdate, $startdate, $enddate, $enddate])->row();
            if (isset($row)) {
                $room->Price = $row->Price;
                $room->Method = $row->Method;
                $room->CustomMethod = $row->CustomMethod;
            }
        }
        echo json_encode($rooms);
    }

    public function getCarPriceById() {
        $categoryid = $this->input->post('CategoryId');
        $startdate = $this->input->post('StartDate');
        $enddate = $this->input->post('EndDate');
        $transmission = ltrim($this->input->post('Transmission'), '.');
        echo json_encode($this->db->query("SELECT IFNULL(MAX(Price),-1) Price FROM cars_prices WHERE CategoryId=? AND Transmission=? AND ((FromDate<=? AND ToDate>=?) OR (FromDate<=? AND ToDate>=?))", [$categoryid, $transmission, $startdate, $startdate, $enddate, $enddate])->row()->Price);
    }

    public function getRoundtripRoomById() {
        $roundtripid = $this->input->post('RoundtripId');
        $startdate = $this->input->post('StartDate');
        $enddate = $this->input->post('EndDate');
        $rooms = $this->db->query("SELECT * FROM roundtrips_rooms$this->lang WHERE RoundtripId=?", $roundtripid)->result();
        foreach ($rooms as $room)
            $room->Price = $this->db->query("SELECT IFNULL(MAX(Price),-1) Price FROM roundtrips_rooms_prices WHERE RoundtripId=? AND RoomId=? AND ((FromDate<=? AND ToDate>=?) OR (FromDate<=? AND ToDate>=?))", [$roundtripid, $room->Id, $startdate, $startdate, $enddate, $enddate])->row()->Price;
        echo json_encode($rooms);
    }

    public function addPackRoom() {
        $stdPack = $this->input->post();
        $stdPack['Type'] = 'packs';
        echo json_encode($this->ictcart->addCartItem((object)$stdPack));
    }

    public function addHotelRoom() {
        $stdHotel = $this->input->post();
        $stdHotel['Type'] = 'hotels';
        echo json_encode($this->ictcart->addCartItem((object)$stdHotel));
    }

    public function addEventHotelRoom() {
        $stdHotel = $this->input->post();
        $stdHotel['Type'] = 'events';
        echo json_encode($this->ictcart->addCartItem((object)$stdHotel));
    }

    public function addExcursion() {
        $stdExcursion = $this->input->post();
        $stdExcursion['Type'] = 'excursions';
        echo json_encode($this->ictcart->addCartItem((object)$stdExcursion));
    }

    public function addRoundtrip() {
        $stdRoundtrip = $this->input->post();
        $stdRoundtrip['Type'] = 'roundtrips';
        echo json_encode($this->ictcart->addCartItem((object)$stdRoundtrip));
    }

    /**
     * dCart == removeCart
     */
    public function dCart() {
        echo json_encode($this->ictcart->removeCart($this->input->post('Id')));
    }

    /**
     * Callback de Azubapay cuando el cliente paga correctamente
     */
    public function PaymentSuccess($ict_payid) {
        ict_log_message($ict_payid . ' ==> ICT Payment Success - Received');
        $this->ictemail->sendEmail('InCubaTravel Web Site',
            'reservation@incubatravel.com', $this->config->item('seller_email'),
            "PaymentSuccess", "InCubaTravel Web Site Payment Id: " . $ict_payid);
        $payment['status'] = $this->input->post('status');
        $payment['code'] = $this->input->post('code');
        $payment['reference'] = $this->input->post('reference');
        $this->db->trans_begin();
        $this->db->where('ict_payid', $ict_payid);
        $this->db->update('paymentsrequests', $payment);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            ict_log_message($ict_payid . ' ==> ICT Payment Success - DB Error');
        } else {
            $this->db->trans_commit();
            ict_log_message($ict_payid . ' ==> ICT Payment Success - DB OK');
        }
    }

    /**
     * Callback de Azubapay cuando el cliente NO pudo realizar el pago correctamente
     */
    public function PaymentError($ict_payid) {
        log_message('info', 'ICT Payment Error - ' . $ict_payid . ' - Received');
        $this->ictemail->sendEmail('InCubaTravel Web Site',
            'reservation@incubatravel.com', $this->config->item('seller_email'),
            "PaymentError", "Payment Id: " . $ict_payid);
        $payment['status'] = $this->input->post('status');
        $payment['error'] = $this->input->post('error');
        $this->db->trans_begin();
        $this->db->where('ict_payid', $ict_payid);
        $this->db->update('paymentsrequests', $payment);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            ict_log_message($ict_payid . ' ==> ICT Payment Error - DB Error');
        } else {
            $this->db->trans_commit();
            ict_log_message($ict_payid . ' ==> ICT Payment Error - DB OK');
        }
    }
}