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

            // Check if user needs to change password
            $redirect_url = $this->get_redirect_url($role);
            if ($role == 'pemilih' && isset($user['default_password']) && $user['default_password'] == 1) {
                $redirect_url = base_url('auth/change_password');
            }

            $response = array(
                'status' => 'success',
                'message' => 'Login berhasil',
                'redirect' => $redirect_url
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

    public function change_password() {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('user_role') != 'pemilih') {
            redirect('auth');
        }
        
        $this->load->view('change_password');
    }

    public function update_password() {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('user_role') != 'pemilih') {
            echo json_encode(array('status' => 'error', 'message' => 'Unauthorized'));
            return;
        }

        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');
        $user_id = $this->session->userdata('user_id');

        // Validasi
        if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
            echo json_encode(array('status' => 'error', 'message' => 'Semua field harus diisi'));
            return;
        }

        if ($new_password !== $confirm_password) {
            echo json_encode(array('status' => 'error', 'message' => 'Password baru dan konfirmasi tidak sama'));
            return;
        }

        if (strlen($new_password) < 6) {
            echo json_encode(array('status' => 'error', 'message' => 'Password minimal 6 karakter'));
            return;
        }

        // Verifikasi password lama
        $user = $this->Auth_model->get_user_by_phone($user_id);
        if (!password_verify($current_password, $user['password'])) {
            echo json_encode(array('status' => 'error', 'message' => 'Password lama salah'));
            return;
        }

        // Update password
        if ($this->Auth_model->change_password($user_id, $new_password)) {
            echo json_encode(array(
                'status' => 'success', 
                'message' => 'Password berhasil diubah',
                'redirect' => base_url('voting')
            ));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Gagal mengubah password'));
        }
    }
}