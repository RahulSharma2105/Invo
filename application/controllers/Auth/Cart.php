<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    private $api_url;

    public function __construct() {
        parent::__construct();
        $this->api_url = base_url("api/cart");
        $this->load->helper(['url','form']);
    }
    private function call_api($url, $method = "GET", $data = []) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($method === "POST") {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        $resp = curl_exec($ch);
        curl_close($ch);
        return json_decode($resp, true);
    }
    public function index() {
        // echo 'ok';die;
        $response = $this->call_api($this->api_url); 
        $data['cart_items'] = $response['data'] ?? [];
        $this->load->view('Backend/cart_display', $data);
    }

    public function order() {
        // echo 'ok';die;
        $response = $this->call_api($this->api_url . '/order'); 
        $data['order_items'] = $response['data'] ?? [];
        $this->load->view('Backend/order_display', $data);
    }
}
