<?php

/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 4/27/2017
 * Time: 8:40 AM
 */
class ICTCart
{

    protected $cart;
    protected $total;
    protected $CI;

    function __construct() {
        $this->CI = &get_instance();
        $this->cart = $this->CI->session->userdata('Cart') ? $_SESSION['Cart'] : [];
        $this->total = floatval($this->CI->session->userdata('CartTotal'));
    }

    public function Length() {
        return count($this->cart);
    }

    public function Total() {
        return $this->total;
    }

    public function Items() {
        return $this->cart;
    }

    protected function updateTotal() {
        $this->total = 0;
        foreach ($this->cart as $item) {
            $this->total += $item->Price;
        }
        $this->CI->session->set_userdata('CartTotal', $this->total);
    }

    public function addCartItem($stdclass) {
        array_push($this->cart, $stdclass);
        $this->CI->session->set_userdata('Cart', $this->cart);
        $this->updateTotal();
        return ['length' => $this->Length(), 'total' => $this->Total()];
    }

    public function getItemsJSON() {
        $result = [];
        foreach ($this->cart as $item) {
            $result[] = ['Id' => $item->Id, 'Type' => $item->Type, 'Name' => $item->Name, 'Price' => $item->Price,'StartDate'=>$item->StartDate,'EndDate'=>$item->EndDate];
        }
        return json_encode($result);
    }

    public function removeCart($id) {
        $pos = 0;
        foreach ($this->cart as $item) {
            if ($item->Id == $id) {
                array_splice($this->cart, $pos, 1);
                break;
            }
            $pos++;
        }
        $this->CI->session->set_userdata('Cart', $this->cart);
        $this->updateTotal();
        return ['length' => $this->Length(), 'total' => $this->Total()];
    }
}