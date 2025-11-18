<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index() {
        $this->load->view('login');
    }

    public function login() {
        $user_id = $this->input->post('user_id');
        $password = $this->input->post('password');
        $role = $this->input->post('role');

        $user = $this->Auth_model->validate_user($user_id, $password, $role);

        if ($user) {
            $session_data = array(
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'user_role' => $role,
                'logged_in' => TRUE
            );

            if ($role == 'calon') {
                $session_data['candidate_number'] = $user['candidate_number'];
            }

            $this->session->set_userdata($session_data);

            $response = array(
                'status' => 'success',
                'message' => 'Login berhasil',
                'redirect' => $this->get_redirect_url($role)
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'ID atau password salah'
            );
        }

        echo json_encode($response);
    }

    private function get_redirect_url($role) {
        switch ($role) {
            case 'admin':
                return base_url('admin');
            case 'calon':
                return base_url('candidate');
            case 'pemilih':
                return base_url('voting');
            default:
                return base_url();
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}