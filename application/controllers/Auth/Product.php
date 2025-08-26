<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    private $api_url;

    public function __construct() {
        parent::__construct();
        $this->api_url = base_url("api/products");
        $this->load->helper(['url','form']);
    }
    private function call_api($url, $method = "GET", $data = []) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($method == "POST") {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } elseif ($method == "PUT") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } elseif ($method == "DELETE") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        $resp = curl_exec($ch);
        curl_close($ch);
        return json_decode($resp, true);
    } 

    private function call_api1($url, $method = 'GET', $data = [], $is_multipart = false) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    if (strtoupper($method) === 'POST') {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $is_multipart ? $data : http_build_query($data));
    }

    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
}

    public function index() {
        $response = $this->call_api($this->api_url);
        $data['products'] = $response['data'] ?? [];
        $this->load->view('Backend/product', $data);
    }
    public function view($id) {
        $response = $this->call_api($this->api_url . "/" . $id);
        $data['product'] = $response['data'] ?? null;
        if (!$data['product']) show_404();
        $this->load->view('Backend/product_view', $data);
    }

public function create() {
    if ($this->input->method() == 'post') {
        $post = $this->input->post(); 

        if (!empty($_FILES['images']['name'][0])) {
            $files = [];
            foreach ($_FILES['images']['tmp_name'] as $i => $tmp_name) {
                if ($tmp_name) {
                    $files['images['.$i.']'] = new CURLFile(
                        $tmp_name,
                        $_FILES['images']['type'][$i],
                        $_FILES['images']['name'][$i]
                    );
                }
            }
            $post = array_merge($post, $files);
        }
        $response = $this->call_api($this->api_url, "POST", $post, true); 

        redirect('admin/products');
    } 
    $this->load->view('Backend/product_create');
}
    public function delete($id) {
        $this->call_api($this->api_url . "/" . $id, "DELETE");
        redirect('admin/products');
    }


public function edit($id) {
    // Check if form is submitted
    if ($this->input->method() == 'post') {

        // Collect all text fields manually
        $post = [
            'product_name' => $this->input->post('product_name'),
            'price'        => $this->input->post('price'),
            'description'  => $this->input->post('description'),
            'status'       => $this->input->post('status') ? 1 : 0,
            '_method'      => 'PUT' // optional, for API logic
        ];

        // Add multiple images as CURLFile objects
        if (!empty($_FILES['images']['name'][0])) {
            foreach ($_FILES['images']['tmp_name'] as $i => $tmp_name) {
                if ($tmp_name) {
                    $post['images[]'] = new CURLFile(
                        $tmp_name,
                        $_FILES['images']['type'][$i],
                        $_FILES['images']['name'][$i]
                    );
                }
            }
        }

        // Call API (POST with multipart/form-data)
        $response = $this->call_api1($this->api_url . "/" . $id, "POST", $post, true);

        // Redirect to products list
        redirect('admin/products');
    }

    // Load product data to show in edit form
    $response = $this->call_api1($this->api_url . "/" . $id);
    $data['product'] = $response['data'] ?? null;
    if (!$data['product']) show_404();

    $this->load->view('Backend/product_edit', $data);
}

}

