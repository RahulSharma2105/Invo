<?php
class Admin_model extends CI_Model {

    public function check_login($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        return $this->db->get('tbl_admin')->row();
    }
}
