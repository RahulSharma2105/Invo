<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('session');
    }

    public function login() {
        $data['error'] = '';

        if ($this->input->post()) {
            // echo "ok"; exit;
            $email    = $this->input->post('email');
            $password = $this->input->post('password');

            $admin = $this->Admin_model->check_login($email, $password);

            if ($admin) {
                $this->session->set_userdata([
                    'admin_id' => $admin->id,
                    'admin_name' => $admin->name,
                    'admin_logged_in' => true
                ]);
                redirect('admin/dashboard');
            } else {
                $data['error'] = "Invalid email or password!";
            }
        }

        $this->load->view('Backend/login', $data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/login');
    }

    public function dashboard() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        $this->load->view('Backend/dashboard');
    }
}
