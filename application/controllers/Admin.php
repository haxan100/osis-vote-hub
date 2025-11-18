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
        $this->load->model('Candidate_model');
        $data['admin_name'] = $this->session->userdata('user_name');
        $data['candidates'] = $this->Candidate_model->get_all_candidates();
        $this->load->view('admin/dashboard', $data);
    }
}