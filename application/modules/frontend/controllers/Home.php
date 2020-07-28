<?php

/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 3/30/2017
 * Time: 5:47 AM
 */
class Home extends MX_Controller
{

    function __construct() {
        if (!$this->session->has_userdata('language')) {
            $this->session->set_userdata('language', 'english');
            $this->session->set_userdata('lang', 'en');
            $this->session->set_userdata('CartTotal', 0);
            $this->session->set_userdata('Cart', []);
            $this->session->set_userdata('currency', 'EUR');
        }
        $this->lang->load('incubatravel', $this->session->userdata('language'));
        $this->load->model('M_home');
        if (!$this->session->has_userdata('rate'))
            $this->session->set_userdata('rate', $this->M_home->getCurrencyRate());
    }

    public function Lang() {
        if ($this->session->userdata('lang') == 'en') {
            $this->session->set_userdata('language', 'spanish');
            $this->session->set_userdata('lang', 'es');
        } else {
            $this->session->set_userdata('language', 'english');
            $this->session->set_userdata('lang', 'en');
        }
        redirect($this->session->userdata('selfcall') . '/' . $this->session->userdata('callparams'));
    }

    public function Currency($currency = 'EUR') {
        $this->session->set_userdata('currency', $currency);
        $this->session->set_userdata('rate', $this->M_home->getCurrencyRate());
        redirect($this->session->userdata('selfcall') . '/' . $this->session->userdata('callparams'));
    }

    public function Home() {
        $this->M_home->updateVisit('Home');
        $data['Carousel'] = $this->M_home->getCarousel();
        $data['Hotels'] = $this->M_home->getTopHotels();
        $data['Cars'] = $this->M_home->getTopCars();
        $data['Excursions'] = $this->M_home->getTopExcursions();
        $data['Packs'] = $this->M_home->getTopPacks();
        $data['Roundtrips'] = $this->M_home->getTopRoundtrips();
        $this->load->view('home', $data);
    }

    public function Policies() {
        $this->M_home->updateVisit('Policies');
        $data['Carousel'] = $this->M_home->getCarousel();
        $data['Policies'] = $this->M_home->getPolicies();
        $this->load->view('policies', $data);
    }

    public function ContactUs() {
        $this->M_home->updateVisit('ContactUs');
        $data['Carousel'] = $this->M_home->getCarousel();
        $this->load->view('contactus', $data);
    }

    public function AboutUs() {
        $this->M_home->updateVisit('AboutUs');
        $data['Carousel'] = $this->M_home->getCarousel();
        $data['About'] = $this->M_home->getAbout();
        $this->load->view('aboutus', $data);
    }

    public function Hotels() {
        $this->M_home->updateVisit('Hotels');
        $data['Carousel'] = $this->M_home->getCarousel();
        $data['Hotels'] = $this->M_home->getAllHotels();
        $data['Cities'] = $this->M_home->getHotelsCities();
        $this->load->view('hotels', $data);
    }

    public function Packs() {
        $this->M_home->updateVisit('Packs');
        $data['Carousel'] = $this->M_home->getCarousel();
        $data['Packs'] = $this->M_home->getAllPacks();
        $this->load->view('packs', $data);
    }

    public function Roundtrips() {
        $this->M_home->updateVisit('Roundtrips');
        $data['Carousel'] = $this->M_home->getCarousel();
        $data['Roundtrips'] = $this->M_home->getAllRoundtrips();
        $this->load->view('roundtrips', $data);
    }

    public function Excursions() {
        $this->M_home->updateVisit('Excursions');
        $data['Carousel'] = $this->M_home->getCarousel();
        $data['Excursions'] = $this->M_home->getAllExcursions();
        $this->load->view('excursions', $data);
    }

    public function Cars() {
        $this->M_home->updateVisit('Cars');
        $data['Carousel'] = $this->M_home->getCarousel();
        $data['Cars'] = $this->M_home->getAllCars();
        $this->load->view('cars', $data);
    }

    public function Events() {
        $this->M_home->updateVisit('Events');
        $data['Carousel'] = $this->M_home->getCarousel();
        $data['Events'] = $this->M_home->getAllEvents();
        $this->load->view('events', $data);
    }

    public function sendContact() {
        if (strtolower($_POST['Captcha']) != strtolower($_SESSION['captcha'])) {
            echo 'NoCaptcha';
            return;
        }
        $countrySrc = $this->M_home->getClientCountry(getIpAddress());
        $data['lines'] = array(
            'Country' => $countrySrc,
            'Name' => $this->input->post('Name'),
            'Email' => $this->input->post('Email'),
            'Phone' => $this->input->post('Phone'),
            'Message' => $this->input->post('Message'));
        $msg = $this->load->view('msgContact', $data, TRUE);
        $msgAutomatic = $this->load->view('msgAutomatic' . $this->session->userdata('lang'), null, TRUE);
        if (!$this->ictemail->sendEmail('WEB Contact - ' . $_POST['Name'],
                $_POST['Email'], 'contact@********',
                "InCubaTravel Web Contact", $msg) ||
            !$this->ictemail->sendEmail('InCubaTravel by Grupo Gira S.A. - Automatic Answer',
                'info@********', $_POST['Email'],
                "InCubaTravel by Grupo Gira S.A. - Automatic Answer", $msgAutomatic)
        ) {
            echo "Error";
        }
    }

    public function CartHotel($id) {
        $this->M_home->updateVisit('CartHotel', $id);
        $data['Carousel'] = $this->M_home->getCarousel();
        $data['Hotel'] = $this->M_home->getHotelById($id);
        $this->load->view('carthotel', $data);
    }

    public function CartPack($id) {
        $this->M_home->updateVisit('CartPack', $id);
        $data['Carousel'] = $this->M_home->getCarousel();
        $data = array_merge($data, $this->M_home->getPackById($id));
        $this->load->view('cartpack', $data);
    }

    public function CartRoundtrip($id) {
        $this->M_home->updateVisit('CartRoundtrip', $id);
        $data['Carousel'] = $this->M_home->getCarousel();
        $data['Roundtrip'] = $this->M_home->getRoundtripById($id);
        $this->load->view('cartroundtrip', $data);
    }

    public function CartExcursion($id) {
        $this->M_home->updateVisit('CartExcursion', $id);
        $data['Carousel'] = $this->M_home->getCarousel();
        $data['Excursion'] = $this->M_home->getExcursionById($id);
        $data['Pickup'] = $this->M_home->getAllExcursionsPickup();
        $this->load->view('cartexcursion', $data);
    }

    public function CartCar($id) {
        $this->M_home->updateVisit('CartCar', $id);
        $data['Carousel'] = $this->M_home->getCarousel();
        $data = array_merge($data, $this->M_home->getCarsData(), $this->M_home->getCarsById($id));
        $this->load->view('cartcar', $data);
    }

    public function CartEvent($id) {
        $this->M_home->updateVisit('CartEvent', $id);
        $data['Carousel'] = $this->M_home->getCarousel();
        $data = array_merge($data, $this->M_home->getEventsById($id));
        $this->load->view('cartevent',$data);
    }

    public function Checkout() {
        if ($this->ictcart->Length() === 0) {
            redirect('Home');
            return;
        }
        $this->M_home->updateVisit('Checkout');
        $data['Carousel'] = $this->M_home->getCarousel();
        $this->load->view('checkout', $data);
    }

    public function confirmPayment() {
        $jsonResult = array('Code' => '');
        if (strtolower($_POST['Customer']['captcha']) != strtolower($_SESSION['captcha'])) {
            $jsonResult['Code'] = 'NoCaptcha';
            echo json_encode($jsonResult);
            return;
        }
        $customer = $this->input->post('Customer');
        $total = $this->input->post('Total');
        $ict_payid = $this->M_home->createPaymentRequest($customer, $total);
        if ($ict_payid === 'Error') {
            $jsonResult['Code'] = 'Error';
            echo json_encode($jsonResult);
            return;
        }
        ict_log_message($ict_payid . ' ==> createPaymentRequest');
        $this->ictemail->sendEmail('InCubaTravel Web Site',
            'info@********', $this->config->item('seller_email'),
            "createPaymentRequest", "InCubaTravel Web Site Payment Id: " . $ict_payid);
        $postData = $this->getHttpQuery($ict_payid, $customer, $total);
        $opts = array('http' =>
            array(
                'method' => 'POST',
                /*'proxy' => 'tcp://192.168.30.120:3128',*/
                'header' => "Content-type: application/x-www-form-urlencoded\r\n"
                    . "Content-Length: " . strlen($postData) . "\r\n",
                'content' => $postData
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($this->config->item('azubapay_url')
            . $this->config->item('azubapay_paymentroute'), false, $context);
        if (is_bool($result)) {
            ict_log_message($ict_payid . " ==> ERROR [file_get_contents]");
            $this->M_home->PaymentRequestError($ict_payid, 'file_get_contents');
            $jsonResult['Code'] = 'Error';
            echo json_encode($jsonResult);
            return;
        }
        parse_str($result, $output);
        if ($output['status'] === "FAIL") {
            ict_log_message($ict_payid . ' ==> FAIL ==> ' . $output['error']);
            $this->M_home->PaymentRequestError($ict_payid, $output['error']);
            $jsonResult['Code'] = 'Error';
            echo json_encode($jsonResult);
            return;
        }
        ict_log_message(sprintf('%s ==> %s ==> %s ==> %s', $ict_payid, $output['status'], $output['code'], $output['reference']));
        $this->M_home->PaymentRequestUpdate($ict_payid, $output['status'], $output['code'], $output['reference']);
        $jsonResult['Code'] = 'Ok';
        $jsonResult['Redirect'] = sprintf('%s%s%s?modality=%s', $this->config->item('azubapay_url'),
            $this->config->item('azubapay_loadtransaction'), $output['code'], $this->config->item('azubapay_modality'));
        echo json_encode($jsonResult);
    }

    public function PaymentSuccess($ict_payid) {
        $this->session->sess_destroy();
        $this->M_home->updateVisit('PaymentSuccess', $ict_payid);
        $data['Carousel'] = $this->M_home->getCarousel();
        $data['PaymentSuccess'] = $this->M_home->getPaymentSuccess($this->session->userdata('lang'));
        $data['ict_payid'] = $ict_payid;
        $msg = $this->load->view('msgVoucher', $data, TRUE);
        $clientEmail = $this->M_home->getClientEmail($ict_payid);
        if (!$this->M_home->confirmClientPayment($ict_payid)) {
            ict_log_message($ict_payid . ' NOT CONFIRMED');
            $gira = $this->load->view('msgConfirmationError', ['ict_payid' => $ict_payid], TRUE);
            $this->ictemail->sendEmail('InCubaTravel Web Site',
                'info@********', $this->config->item('seller_email'),
                'Error confirmando al cliente', $gira);
        }
        $this->ictemail->sendEmail('InCubaTravel Web Site',
            'info@********', $clientEmail . ';' . $this->config->item('seller_email'),
            "PDF Voucher", $msg);
        $this->load->view('paymentSuccess', $data);
    }

    public function vouchersGenerator($ict_payid) {
        $data = $this->M_home->getRequest($ict_payid);
        if ($data['Payment']->paid === '1') {
            $voucherview = $data['Payment']->type === 'cars' ? 'voucherapdf' : 'voucherpdf';
            $viewrender = $this->load->view($voucherview, $data, TRUE);
            $pdf = $this->ictpdf->load_htmlview($viewrender);
            header('X-Content-Type-Options: nosniff');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $ict_payid . '.pdf"');
            ict_log_message('vouchersGenerator: ' . $ict_payid);
            echo $pdf;
        } else echo 'Request Payment NOT CONFIRMED';
    }

    public function vouchersViewer($ict_payid) {
        $data = $this->M_home->getRequest($ict_payid);
        if ($data['Payment']->paid === '1') {
            $voucherview = $data['Payment']->type === 'cars' ? 'voucheraview' : 'voucherview';
            $this->load->view($voucherview, $data);
        } else echo 'Request Payment NOT CONFIRMED';
    }

    public function requestCar() {
        $jsonResult = array('Code' => '');
        if (strtolower($_POST['Customer']['captcha']) != strtolower($_SESSION['captcha'])) {
            $jsonResult['Code'] = 'NoCaptcha';
            echo json_encode($jsonResult);
            return;
        }
        $customer = $this->input->post('Customer');
        $reservation = $this->input->post('Reservation');
        $ict_payid = $this->M_home->createCarPaymentRequest($customer, $reservation);
        if ($ict_payid === 'Error') {
            $jsonResult['Code'] = 'Error';
            echo json_encode($jsonResult);
            return;
        }
        ict_log_message($ict_payid . ' ==> createCarPaymentRequest');
        if (!$this->ictemail->sendEmail('InCubaTravel Web Site',
            'info@********', $this->config->item('seller_email'),
            "createCarPaymentRequest", "InCubaTravel Web Site Car Payment Id: " . $ict_payid)
        )
            ict_log_message('createCarPaymentRequest NOT SEND TO SELLER');

        $postData = $this->getHttpQuery($ict_payid, $customer, $reservation['TotalPrice']);
        $opts = array('http' =>
            array(
                'method' => 'POST',
                //'proxy' => 'tcp://192.168.30.120:3128',
                'header' => "Content-type: application/x-www-form-urlencoded\r\n"
                    . "Content-Length: " . strlen($postData) . "\r\n",
                'content' => $postData
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($this->config->item('azubapay_url')
            . $this->config->item('azubapay_paymentroute'), false, $context);
        if (is_bool($result)) {
            ict_log_message($ict_payid . " ==> ERROR [file_get_contents]");
            $this->M_home->PaymentRequestError($ict_payid, 'file_get_contents');
            $jsonResult['Code'] = 'Error';
            echo json_encode($jsonResult);
            return;
        }
        parse_str($result, $output);
        if ($output['status'] === "FAIL") {
            ict_log_message($ict_payid . ' ==> FAIL ==> ' . $output['error']);
            $this->M_home->PaymentRequestError($ict_payid, $output['error']);
            $jsonResult['Code'] = 'Error';
            echo json_encode($jsonResult);
            return;
        }
        ict_log_message(sprintf('%s ==> %s ==> %s ==> %s', $ict_payid, $output['status'], $output['code'], $output['reference']));
        $this->M_home->PaymentRequestUpdate($ict_payid, $output['status'], $output['code'], $output['reference']);

        $jsonResult['Code'] = 'Ok';

        $msgAutomatic = $this->load->view('msgAuto' . $this->session->userdata('lang'), ['ict_payid' => $ict_payid], TRUE);
        if (!$this->ictemail->sendEmail('InCubaTravel by Grupo Gira S.A.',
            'reservation@********', $customer['email'],
            "InCubaTravel by Grupo Gira S.A.", $msgAutomatic)
        ) {
            ict_log_message('Car Automatic Answer NOT SEND TO CUSTOMER');
            $this->M_home->ErrorSendTo($ict_payid, 'sendtoclient');
        }
        $msgAutomatic = $this->load->view('msgIctAuto', ['customer' => (object)$customer, 'reservation' => (object)$reservation], TRUE);
        if (!$this->ictemail->sendEmail('InCubaTravel by Grupo Gira S.A.',
            'reservation@********', $this->config->item('seller_email'),
            "InCubaTravel - Solicitud de Auto", $msgAutomatic)
        ) {
            ict_log_message('Car Automatic Answer NOT SEND TO SELLER');
            $this->M_home->ErrorSendTo($ict_payid, 'sendtoseller');
        }
        echo json_encode($jsonResult);
    }

    protected function getHttpQuery($ict_payid, $customer, $total) {
        return http_build_query(array(
            'description' => $this->config->item('azubapay_description'),
            'first_name' => $customer['first_name'],
            'last_name' => $customer['last_name'],
            'email' => $customer['email'],
            'amount' => (int)($total * 100),
            'user' => $this->config->item('azubapay_user'),
            'api_key' => $this->config->item('azubapay_apikey'),
            'notify' => $this->config->item('azubapay_notify'),
            'currency' => $this->config->item('azubapay_currency'),
            'expire_days' => $this->config->item('azubapay_expire_days'),
            'cancelation_fee' => $this->config->item('azubapay_cancelation_fee'),
            'locale' => $this->session->userdata('lang'),
            'return_url' => base_url('PaymentSuccess/' . $ict_payid),
            'success_url' => base_url('SuccessUrl/' . $ict_payid),
            'error_url' => base_url('ErrorUrl/' . $ict_payid),
        ));
    }

    public function CarConfirmation($ict_payid) {
        $data['Carousel'] = $this->M_home->getCarousel();
        $data = array_merge($data, $this->M_home->getRequest($ict_payid));
        $this->load->view('carsConfirmation', $data);
    }

    public function Currencies($apikey) {
        if ($this->M_home->validApiKey($apikey)) {
            redirect('Home');
            return;
        }
        $data['Carousel'] = $this->M_home->getCarousel();
        $data['Currencies'] = $this->M_home->getAllCurrencies();
        $this->load->view('currencies', $data);
    }

    public function changeRate() {
        if ($this->M_home->validApiKey($this->input->post('apikey'))) {
            echo '{"code":"ErrorApiKey"}';
            return;
        }
        if (!$this->M_home->changeRate($this->input->post('isocode'),$this->input->post('rate'))){
            echo '{"code":"ErrorDB"}';
            return;
        }
        echo json_encode(['code'=>'Ok', 'currencies'=>$this->M_home->getAllCurrencies()]);
    }

    public function sendCarConfirmation() {
        if ($this->M_home->validApiKey($this->input->post('apikey'))) {
            echo 'ErrorApiKey';
            return;
        }
        $ict_payid = $this->input->post('ict_payid');
        if ($this->M_home->carObservations($ict_payid, $this->input->post('observations'))) {
            echo 'ErrorDB';
            return;
        }
        $data = $this->M_home->getRequest($ict_payid);
        $data['redirect'] = sprintf('%s%s%s?modality=%s', $this->config->item('azubapay_url'),
            $this->config->item('azubapay_loadtransaction'), $data['Payment']->code, $this->config->item('azubapay_modality'));
        $msg = $this->load->view('msgAutoCanPay' . $data['Payment']->locale, $data, TRUE);
        if (!$this->ictemail->sendEmail('InCubaTravel Web Site',
            'info@********', $data['Payment']->email . ';' . $this->config->item('seller_email'),
            "PDF Voucher", $msg)
        ) echo 'ErrorMail'; else echo 'Ok';
    }

    public function ManualConfirmation($ict_payid) {
        $data['Carousel'] = $this->M_home->getCarousel();
        $data = array_merge($data, $this->M_home->getRequest($ict_payid));
        $this->load->view('manualConfirmation', $data);
    }

    public function executeManualConfirmation() {
        if ($this->M_home->validApiKey($this->input->post('apikey'))) {
            echo 'ErrorApyKey';
            return;
        }
        $ict_payid = $this->input->post('ict_payid');
        if (!$this->M_home->confirmClientPayment($ict_payid)) {
            echo 'ErrorDB';
            return;
        }
        $rpay = $this->M_home->getRequest($ict_payid);
        $data['PaymentSuccess'] = $this->M_home->getPaymentSuccess($rpay['Payment']->locale);
        $data['ict_payid'] = $ict_payid;
        $msg = $this->load->view('msgVoucher', $data, TRUE);
        if (!$this->ictemail->sendEmail('InCubaTravel Web Site',
            'info@********', $rpay['Payment']->email . ';' . $this->config->item('seller_email'),
            "PDF Voucher", $msg)
        ) echo 'ErrorMail'; else echo 'Ok';
    }

    public function getAllHotelsByCity() {
        echo json_encode($this->M_home->getAllHotelsByCity($this->input->post('City')));
    }
}