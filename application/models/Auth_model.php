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
                    if ($password === 'pemilih123') { // Simple check for demo
                        return array('id' => $user['user_id'], 'name' => $user['name']);
                    }
                }
                break;
                
            case 'admin':
                $this->db->where('username', $user_id);
                $query = $this->db->get('admins');
                if ($query->num_rows() > 0) {
                    $user = $query->row_array();
                    if ($password === 'admin123') { // Simple check for demo
                        return array('id' => $user['username'], 'name' => $user['name']);
                    }
                }
                break;
                
            case 'calon':
                $this->db->where('user_id', $user_id);
                $query = $this->db->get('candidate_users');
                if ($query->num_rows() > 0) {
                    $user = $query->row_array();
                    if ($password === 'calon123') { // Simple check for demo
                        return array('id' => $user['user_id'], 'name' => $user['name'], 'candidate_number' => $user['candidate_number']);
                    }
                }
                break;
        }
        
        return false;
    }
}