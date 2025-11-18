<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_login();
    }

    private function check_login() {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('user_role') != 'admin') {
            redirect('auth');
        }
    }

    public function index() {
        $data['admin_name'] = $this->session->userdata('user_name');
        $this->load->view('admin/dashboard', $data);
    }
}