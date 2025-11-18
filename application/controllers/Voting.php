<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_login();
    }

    private function check_login() {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('user_role') != 'pemilih') {
            redirect('auth');
        }
    }

    public function index() {
        // Check if user still has default password
        $this->load->model('Auth_model');
        $user = $this->Auth_model->get_user_by_phone($this->session->userdata('user_id'));
        
        if ($user['default_password'] == 1) {
            redirect('auth/change_password');
        }

        $data['user_name'] = $this->session->userdata('user_name');
        $this->load->view('voting/dashboard', $data);
    }
}