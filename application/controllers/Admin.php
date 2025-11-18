<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Candidate_model');
        $this->check_login();
    }

    private function check_login() {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('user_role') != 'admin') {
            redirect('auth');
        }
    }

    public function index() {
        $data['admin_name'] = $this->session->userdata('user_name');
        $data['candidates'] = $this->Candidate_model->get_all_candidates();
        $this->load->view('admin/dashboard', $data);
    }

    public function users() {
        $data['admin_name'] = $this->session->userdata('user_name');
        $data['users'] = $this->Auth_model->get_all_users();
        $this->load->view('admin/users', $data);
    }

    public function delete_user() {
        $user_id = $this->input->post('user_id');
        
        if ($this->Auth_model->delete_user($user_id)) {
            $response = array('status' => 'success', 'message' => 'User berhasil dihapus');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menghapus user');
        }
        
        echo json_encode($response);
    }

    public function reset_password() {
        $user_id = $this->input->post('user_id');
        
        if ($this->Auth_model->reset_password($user_id)) {
            $response = array('status' => 'success', 'message' => 'Password berhasil direset');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal reset password');
        }
        
        echo json_encode($response);
    }

    public function edit_user() {
        $user_id = $this->input->post('user_id');
        $name = $this->input->post('name');
        $kelas = $this->input->post('kelas');
        $phone = $this->input->post('phone');
        
        $data = array(
            'name' => $name,
            'kelas' => $kelas,
            'user_id' => $phone
        );
        
        if ($this->Auth_model->update_user($user_id, $data)) {
            $response = array('status' => 'success', 'message' => 'Data user berhasil diupdate');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal update data user');
        }
        
        echo json_encode($response);
    }

    public function users_datatable() {
        $draw = $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];
        $order_column = $this->input->post('order')[0]['column'];
        $order_dir = $this->input->post('order')[0]['dir'];
        
        $users = $this->Auth_model->get_users_datatable($start, $length, $search, $order_column, $order_dir);
        $total_records = $this->Auth_model->count_all_users();
        $filtered_records = $this->Auth_model->count_users_datatable($search);
        
        $data = array();
        $no = $start + 1;
        
        foreach ($users as $user) {
            $row = array();
            $row[] = $no++;
            $row[] = $user['name'];
            $row[] = $user['user_id'];
            $row[] = $user['kelas'] ?? '-';
            $row[] = $user['has_voted'] ? '<span class="badge-success">Sudah Voting</span>' : '<span class="badge-warning">Belum Voting</span>';
            $row[] = $user['default_password'] ? '<span class="badge-danger">Ya</span>' : '<span class="badge-success">Tidak</span>';
            $row[] = '<button class="btn-edit" onclick="editUser('.$user['id'].', \''.$user['name'].'\', \''.$user['user_id'].'\', \''.$user['kelas'].'\')" title="Edit">✏️</button>
                     <button class="btn-reset" onclick="resetPassword('.$user['id'].', \''.$user['name'].'\')" title="Reset Password">🔄</button>
                     <button class="btn-delete" onclick="deleteUser('.$user['id'].', \''.$user['name'].'\')" title="Hapus">🗑️</button>';
            $data[] = $row;
        }
        
        $response = array(
            'draw' => intval($draw),
            'recordsTotal' => $total_records,
            'recordsFiltered' => $filtered_records,
            'data' => $data
        );
        
        echo json_encode($response);
    }
}