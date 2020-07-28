<?php

/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 3/30/2017
 * Time: 5:48 AM
 */
class M_home extends CI_Model
{
    protected $lang;

    function __construct() {
        $this->lang = $this->session->userdata('lang');
    }

    public function getCurrencyRate() {
        return $this->db->query("SELECT Rate FROM currencies WHERE ISOCode=?", [$this->session->userdata('currency')])->row()->Rate;
    }

    public function getAllCurrencies() {
        return $this->db->query("SELECT * FROM currencies WHERE Active='1'")->result();
    }

    public function getCarousel() {
        return $this->db->query("SELECT Picture,Description FROM gallery$this->lang WHERE Element='carousel' AND Active=1 ORDER BY RAND() LIMIT 5")->result();
    }

    public function getPolicies() {
        return $this->db->query("SELECT Value FROM journals WHERE `Key`='policies' AND Lang=?", [$this->lang])->row()->Value;
    }

    public function getAbout() {
        return $this->db->query("SELECT Value FROM journals WHERE `Key`='about' AND Lang=?", [$this->lang])->row()->Value;
    }

    public function getTopHotels() {
        return $this->db->query("SELECT Id,Name,Description,FromPrice,Stars,Special,IsNew FROM hotels$this->lang WHERE Active=1 AND Highlight=1 AND PackId=0 ORDER BY RankOrder LIMIT 3")->result();
    }

    public function getTopCars() {
        return $this->db->query("SELECT Id,Name,FromPrice,Special,IsNew FROM cars$this->lang WHERE Active=1 AND Highlight=1 ORDER BY RankOrder LIMIT 3")->result();
    }

    public function getTopExcursions() {
        return $this->db->query("SELECT Id,Name,AdultsPrice,Special,IsNew FROM excursions$this->lang WHERE Active=1 AND Highlight=1 ORDER BY RankOrder LIMIT 3")->result();
    }

    public function getTopPacks() {
        return $this->db->query("SELECT Id,Name,FromPrice,Special,IsNew FROM packs$this->lang WHERE Active=1 AND Highlight=1 ORDER BY RankOrder LIMIT 3")->result();
    }

    public function getTopRoundtrips() {
        return $this->db->query("SELECT Id,Name,FromPrice,Special,IsNew FROM roundtrips$this->lang WHERE Active=1 AND Highlight=1 ORDER BY RankOrder LIMIT 3")->result();
    }

    /**
     * Actualiza los contadores de visita de los clientes
     * @param $page Identificador de Página
     * @return bool
     */
    public function updateVisit($page, $params = NULL) {
        $counter = $this->db->query('SELECT Counter FROM counters WHERE Page="Site"')->row()->Counter;
        $this->db->trans_begin();
        if (!isset($_SESSION['visits'])) {
            $this->db->query("UPDATE counters SET Counter = Counter + 1 WHERE Page='Site'");
            $this->db->query("INSERT INTO visits VALUES(NULL,?,?)", array(getIpAddress(), date('Y-m-d H:i:s')));
            $counter++;
        }
        $this->db->query("UPDATE counters SET Counter = Counter + 1 where Page='$page'");
        $_SESSION['visits'] = $counter;
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }
        $this->db->trans_commit();
        $this->session->set_userdata('selfcall', $page);
        $this->session->set_userdata('callparams', $params);
        return true;
    }

    /**
     * Obtiene el país desde donde el cliente realiza la solicitud
     * @param $ip_addr Dirección IP del cliente
     * @return string País desde donde se realizó la solicitud
     */
    public function getClientCountry($ip_addr) {
        if (in_array($ip_addr, ['localhost', '::1'])) return "Local";
        $citydetails = GetCityDetails();
        return $citydetails->geobytescountry;
    }

    public function getPackById($id) {
        $result['Pack'] = $this->db->query("SELECT * FROM packs$this->lang WHERE Id=?", [$id])->row();
        $result['Hotels'] = $this->db->query("SELECT * FROM hotels$this->lang WHERE PackId=?", [$id])->result();
        return $result;
    }

    public function getHotelById($id) {
        return $this->db->query("SELECT * FROM hotels$this->lang WHERE Id=?", [$id])->row();
    }

    public function getExcursionById($id) {
        return $this->db->query("SELECT * FROM excursions$this->lang WHERE Id=?", [$id])->row();
    }

    public function getRoundtripById($id) {
        return $this->db->query("SELECT * FROM roundtrips$this->lang WHERE Id=?", [$id])->row();
    }

    public function getCarsById($id) {
        $result['Category'] = $this->db->query("select Id,Name from cars$this->lang where Id=?", [$id])->row();
        $result['Cars'] = $this->db->query('SELECT * FROM cars_show WHERE CategoryId=?', [$id])->result();
        return $result;
    }

    public function getCarsData() {
        $result['Explanation'] = $this->db->query("SELECT Value FROM journals WHERE `Key`='cars' AND Lang=?", [$this->lang])->row()->Value;
        $result['Locations'] = $this->db->query("SELECT Place FROM cars_pickup")->result();
        return $result;
    }

    public function getEventsById($id) {
        $result['Event'] = $this->db->query("select * from events$this->lang where Id=?", [$id])->row();
        $result['Categories'] = $this->db->query("select * from events_categories$this->lang where EventId=?", [$id])->result();
        $result['Hotels'] = $this->db->query("SELECT Id,Name,Stars,Picture FROM events_hotels WHERE EventId=?", [$id])->result();
        $result['Rooms'] = $this->db->query("select * from events_rooms$this->lang where EventId=?", [$id])->result();
        $result['Prices'] = $this->db->query("SELECT RoomId,Stay,Price FROM events_rooms_prices WHERE EventId=?", [$id])->result();
        return $result;
    }

    public function getAllHotels() {
        return $this->db->query("select Id,Name,Description,FromPrice,Stars,Special,IsNew,Place from hotels$this->lang where Active=1 AND PackId=0 ORDER BY RankOrder")->result();
    }

    public function getAllHotelsByCity($city) {
        return $this->db->query("select Id,Name,Description,FromPrice,Stars,Special,IsNew,Place from hotels$this->lang where Active=1 AND PackId=0 AND Place=? ORDER BY RankOrder",[$city])->result();
    }

    public function getAllPacks() {
        return $this->db->query("select Id,Name,FromPrice,Special,IsNew,Days from packs$this->lang where Active=1 ORDER BY RankOrder")->result();
    }

    public function getAllRoundtrips() {
        return $this->db->query("select Id,Name,FromPrice,Special,IsNew,Days from roundtrips$this->lang where Active=1 ORDER BY RankOrder")->result();
    }

    public function getAllExcursions() {
        return $this->db->query("select Id,Name,AdultsPrice,ChildrenPrice,Special,IsNew from excursions$this->lang where Active=1 ORDER BY RankOrder")->result();
    }

    public function getAllCars() {
        return $this->db->query("select Id,Name,FromPrice,Special,IsNew from cars$this->lang where Active=1 ORDER BY RankOrder")->result();
    }

    public function getAllEvents() {
        return $this->db->query("select * from events$this->lang where StartDate>DATE(NOW()) ORDER BY StartDate")->result();
    }

    public function getAllExcursionsPickup() {
        return $this->db->query("SELECT Name FROM excursions_pickup WHERE Active='1' ORDER BY Name")->result();
    }

    public function createPaymentRequest($payment, $total) {
        unset($payment['captcha']);
        $payment['type'] = 'hpec';
        $payment['create_date'] = date('Y-m-d H:i:s');
        $payment['locale'] = $this->lang;
        $payment['amount'] = intval(floatval($total) * 100);
        $payment['ict_payid'] = date('Ym-d-His') . sprintf('-%05d', $this->getNextSequence('Vouchers'));
        $this->db->trans_begin();
        $this->db->insert('paymentsrequests', $payment);
        foreach ($this->ictcart->Items() as $item) {
            $cartitem = clone $item;
            unset($cartitem->Id);
            $cartitem->CartGuid = $payment['ict_payid'];
            $this->db->insert('requests', $cartitem);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 'Error';
        }
        $this->db->trans_commit();
        return $payment['ict_payid'];
    }

    public function createCarPaymentRequest($payment, &$reservation) {
        $transmission = ['en' => ['.manual' => 'Manual Transmission', '.automatic' => 'Automatic Transmission'],
            'es' => ['.manual' => 'Transmisión Manual', '.automatic' => 'Transmisión Automática']];
        unset($payment['captcha']);
        $payment['type'] = 'cars';
        $payment['locale'] = $this->lang;
        $payment['create_date'] = date('Y-m-d H:i:s');
        $payment['amount'] = intval(floatval($reservation['TotalPrice']) * 100);
        $payment['ict_payid'] = date('Ym-d-His') . sprintf('-%05d', $this->getNextSequence('Vouchers'));
        $this->db->trans_begin();
        $this->db->insert('paymentsrequests', $payment);
        $spl = explode(' ', $reservation['StartDate']);
        $reservation['CartGuid'] = $payment['ict_payid'];
        $reservation['StartDate'] = $spl[0];
        $reservation['Time'] = $spl[1];
        $reservation['Type'] = 'cars';
        $reservation['Name'] = $this->db->query("select Name from cars$this->lang where Id=?", [$reservation['CategoryId']])->row()->Name;
        unset($reservation['CategoryId']);
        $reservation['Name'] .= ' / ' . $transmission[$this->lang][$reservation['Transmission']];
        $this->db->insert('requests', $reservation);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 'Error';
        }
        $this->db->trans_commit();
        return $payment['ict_payid'];
    }

    public function PaymentRequestError($ict_payid, $error) {
        $this->db->trans_begin();
        $this->db->where('ict_payid', $ict_payid);
        $this->db->set('error', $error);
        $this->db->update('paymentsrequests');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }
        $this->db->trans_commit();
        return true;
    }

    public function ErrorSendTo($ict_payid, $sendto) {
        $this->db->trans_begin();
        $this->db->where('ict_payid', $ict_payid);
        $this->db->set($sendto, date('Y-m-d H:i:s'));
        $this->db->update('paymentsrequests');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }
        $this->db->trans_commit();
        return true;
    }

    public function PaymentRequestUpdate($ict_payid, $status, $code, $reference) {
        $this->db->trans_begin();
        $this->db->where('ict_payid', $ict_payid);
        $this->db->set('status', $status);
        $this->db->set('code', $code);
        $this->db->set('reference', $reference);
        $this->db->update('paymentsrequests');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }
        $this->db->trans_commit();
        return true;
    }

    public function getRequest($ict_payid) {
        $result['Payment'] = $this->db->query("SELECT * FROM paymentsrequests WHERE ict_payid = ?", $ict_payid)->row();
        $result['Items'] = $this->db->query("SELECT * FROM requests WHERE CartGuid = ?", $ict_payid)->result();
        return $result;
    }

    /**
     * Retorna el valor consecutivo de una secuencia
     * @param $name Identificador de la secuencia
     *
     * @return mixed #sequence
     */
    public function getNextSequence($name) {
        $this->db->trans_begin();
        $this->db->query("update counters set Counter=Counter+1 where Page='$name'");
        $result = $this->db->query("select Counter from counters where Page='$name'")->row()->Counter;
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }
        $this->db->trans_commit();
        return $result;
    }

    public function getPaymentSuccess($lang) {
        return $this->db->query("SELECT Value FROM journals WHERE `Key`='paymentsuccess' AND Lang=?", [$lang])->row()->Value;
    }

    public function getClientEmail($ict_payid) {
        return $this->db->query('SELECT email FROM paymentsrequests WHERE ict_payid=?', [$ict_payid])->row()->email;
    }

    public function confirmClientPayment($ict_payid) {
        $this->db->set('paid', 1);
        $this->db->where('ict_payid', $ict_payid);
        $this->db->update('paymentsrequests');
        $error = $this->db->error();
        if ($error['code'] !== 0) {
            ict_log_message($ict_payid . ': Error --> ' . $error['message']);
            return false;
        }
        return true;
    }

    public function validApiKey($apikey) {
        return $this->db->query("SELECT count(*) AS number FROM apikey WHERE ApiKey=?", [$apikey])->row()->number == 0;
    }

    public function carObservations($ict_payid, $observations) {
        $this->db->set('observations', $observations);
        $this->db->where('ict_payid', $ict_payid);
        $this->db->update('paymentsrequests');
        $error = $this->db->error();
        return $error['code'] !== 0;
    }

    public function changeRate($isocode, $rate) {
        $this->db->set('rate', $rate);
        $this->db->set('UpdateDate', date('Y-m-d H:i:s'));
        $this->db->where('ISOCode', $isocode);
        $this->db->update('currencies');
        $error = $this->db->error();
        if ($error['code'] !== 0) {
            ict_log_message(': Error Change Rate--> ' . $error['message']);
            return false;
        }
        return true;
    }

    public function getHotelsCities() {
        return $this->db->query("SELECT count(*) Cnt,Place FROM hotels WHERE Active='1' AND PackId=0 GROUP BY Place ORDER BY Cnt DESC")->result();
    }
}