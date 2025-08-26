<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart_model extends CI_Model
{

    private $table = 'tbl_cart';

    public function __construct()
    {
        parent::__construct();
    }
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function get_all($user_id)
    {
        $this->db->select('tbl_cart.*, tbl_products.product_name, tbl_products.price');
        $this->db->from($this->table);
        $this->db->join('tbl_products', 'tbl_products.id = tbl_cart.product_id', 'left');
        $this->db->where('tbl_cart.user_id', $user_id);
        return $this->db->get()->result();
    }

    public function update_item($cart_id, $data)
    {
        $this->db->where('id', $cart_id);
        return $this->db->update('tbl_cart', $data);
    }
    public function delete_item($cart_id)
    {
        $this->db->where('id', $cart_id);
        return $this->db->delete('tbl_cart');
    }

    public function get_all_cart_items($user_id)
{
    $this->db->select('c.id, c.product_id, c.quantity, p.product_name, p.price');
    $this->db->from('tbl_cart c');
    $this->db->join('tbl_products p', 'p.id = c.product_id', 'left');
    $this->db->where('c.user_id', $user_id);
    return $this->db->get()->result_array();
}

public function create_order($data)
{
    $this->db->insert('tbl_order', $data);
    return $this->db->insert_id();
}

public function clear_cart($user_id)
{
    $this->db->where('user_id', $user_id);
    $this->db->delete('tbl_cart');
}
public function get_all_orders()
    {
        $this->db->select('tbl_order.*, tbl_products.product_name, tbl_products.price');
        $this->db->from('tbl_order');
        $this->db->join('tbl_products', 'tbl_products.id = tbl_order.product_id', 'left');
        return $this->db->get()->result();
    }


}
