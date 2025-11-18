<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function validate_user($user_id, $password, $role) {
        switch ($role) {
            case 'pemilih':
                $this->db->where('user_id', $user_id);
                $query = $this->db->get('users');
                if ($query->num_rows() > 0) {
                    $user = $query->row_array();
                    if (password_verify($password, $user['password'])) {
                        return array(
                            'id' => $user['user_id'], 
                            'name' => $user['name'],
                            'default_password' => $user['default_password']
                        );
                    }
                }
                break;
                
            case 'admin':
                $this->db->where('username', $user_id);
                $query = $this->db->get('admins');
                if ($query->num_rows() > 0) {
                    $user = $query->row_array();
                    if (password_verify($password, $user['password'])) {
                        return array('id' => $user['username'], 'name' => $user['name']);
                    }
                }
                break;
                
            case 'calon':
                $this->db->where('user_id', $user_id);
                $query = $this->db->get('candidate_users');
                if ($query->num_rows() > 0) {
                    $user = $query->row_array();
                    if (password_verify($password, $user['password'])) {
                        return array('id' => $user['user_id'], 'name' => $user['name'], 'candidate_number' => $user['candidate_number']);
                    }
                }
                break;
        }
        
        return false;
    }

    public function get_all_users() {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('users')->result_array();
    }

    public function get_user_by_phone($phone) {
        $this->db->where('user_id', $phone);
        return $this->db->get('users')->row_array();
    }

    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    public function reset_password($id) {
        $user = $this->get_user_by_id($id);
        if ($user) {
            $hashed_password = password_hash('user123', PASSWORD_DEFAULT);
            
            $data = array(
                'password' => $hashed_password,
                'default_password' => 1
            );
            
            return $this->update_user($id, $data);
        }
        return false;
    }

    public function get_user_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('users')->row_array();
    }

    public function change_password($user_id, $new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        $data = array(
            'password' => $hashed_password,
            'default_password' => 0
        );
        
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', $data);
    }

    public function get_users_datatable($start, $length, $search, $order_column, $order_dir) {
        $this->db->select('id, user_id, name, kelas, has_voted, default_password, created_at');
        
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('user_id', $search);
            $this->db->or_like('kelas', $search);
            $this->db->group_end();
        }
        
        $columns = ['id', 'name', 'user_id', 'kelas', 'has_voted', 'default_password', 'created_at'];
        if (isset($columns[$order_column])) {
            $this->db->order_by($columns[$order_column], $order_dir);
        }
        
        $this->db->limit($length, $start);
        return $this->db->get('users')->result_array();
    }

    public function count_users_datatable($search = '') {
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('user_id', $search);
            $this->db->or_like('kelas', $search);
            $this->db->group_end();
        }
        return $this->db->count_all_results('users');
    }

    public function count_all_users() {
        return $this->db->count_all('users');
    }
}