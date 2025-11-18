<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function get_voting_schedule() {
        $this->db->where_in('setting_key', ['voting_start', 'voting_end']);
        $query = $this->db->get('voting_settings');
        
        $settings = array();
        foreach ($query->result_array() as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        
        return $settings;
    }

    public function update_voting_schedule($start_time, $end_time) {
        $this->db->where('setting_key', 'voting_start');
        $this->db->update('voting_settings', array('setting_value' => $start_time));
        
        $this->db->where('setting_key', 'voting_end');
        $this->db->update('voting_settings', array('setting_value' => $end_time));
        
        return $this->db->affected_rows() > 0;
    }
}