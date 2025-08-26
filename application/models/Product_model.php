<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function get_all() {
        return $this->db->get('tbl_products')->result();
    }
    public function get($id) {
        return $this->db->where('id', $id)->get('tbl_products')->row();
    }
    public function insert($data) {
        if (isset($data['images']) && is_array($data['images'])) {
            $data['images'] = json_encode($data['images']);
        }
        $this->db->insert('tbl_products', $data);
        return $this->db->insert_id();
    }
    public function update($id, $data) {
        if (isset($data['images']) && is_array($data['images'])) {
            $data['images'] = json_encode($data['images']);
        }
        return $this->db->where('id', $id)->update('tbl_products', $data);
    }
    public function delete($id) {
        return $this->db->where('id', $id)->delete('tbl_products');
    }
}
