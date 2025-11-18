<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {

    public function add_log($action, $description) {
        $data = array(
            'admin_name' => $this->session->userdata('user_name'),
            'action' => $action,
            'description' => $description,
            'ip_address' => $this->input->ip_address()
        );
        
        return $this->db->insert('admin_logs', $data);
    }

    public function get_logs_datatable($start, $length, $search, $order_column, $order_dir) {
        $this->db->select('id, admin_name, action, description, ip_address, created_at');
        
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('admin_name', $search);
            $this->db->or_like('action', $search);
            $this->db->or_like('description', $search);
            $this->db->group_end();
        }
        
        $columns = ['id', 'admin_name', 'action', 'description', 'ip_address', 'created_at'];
        if (isset($columns[$order_column])) {
            $this->db->order_by($columns[$order_column], $order_dir);
        } else {
            $this->db->order_by('created_at', 'DESC');
        }
        
        $this->db->limit($length, $start);
        return $this->db->get('admin_logs')->result_array();
    }

    public function count_logs_datatable($search = '') {
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('admin_name', $search);
            $this->db->or_like('action', $search);
            $this->db->or_like('description', $search);
            $this->db->group_end();
        }
        return $this->db->count_all_results('admin_logs');
    }

    public function count_all_logs() {
        return $this->db->count_all('admin_logs');
    }
}