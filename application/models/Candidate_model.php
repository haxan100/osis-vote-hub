<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate_model extends CI_Model {

    public function get_all_candidates() {
        $this->db->order_by('candidate_number');
        return $this->db->get('candidates')->result_array();
    }

    public function get_candidate($candidate_number) {
        $this->db->where('candidate_number', $candidate_number);
        return $this->db->get('candidates')->row_array();
    }

    public function insert_candidate($data) {
        return $this->db->insert('candidates', $data);
    }

    public function update_candidate($candidate_number, $data) {
        $this->db->where('candidate_number', $candidate_number);
        return $this->db->update('candidates', $data);
    }

    public function delete_candidate($candidate_number) {
        $this->db->where('candidate_number', $candidate_number);
        return $this->db->delete('candidates');
    }
}