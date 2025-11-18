<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote_model extends CI_Model {

    public function get_vote_statistics() {
        // Get vote counts per candidate
        $this->db->select('c.candidate_number, c.ketua_name, c.wakil_name, COUNT(v.id) as vote_count');
        $this->db->from('candidates c');
        $this->db->join('votes v', 'c.candidate_number = v.candidate_number', 'left');
        $this->db->group_by('c.candidate_number');
        $this->db->order_by('c.candidate_number');
        $vote_data = $this->db->get()->result_array();

        // Add dummy votes for demo
        $dummy_votes = [45, 32, 23];
        foreach ($vote_data as $key => $candidate) {
            $vote_data[$key]['vote_count'] = $dummy_votes[$key] ?? 0;
        }

        // Get total statistics
        $total_voters = 150;
        $total_votes = array_sum(array_column($vote_data, 'vote_count'));
        $remaining_voters = $total_voters - $total_votes;
        $participation = $total_votes > 0 ? round(($total_votes / $total_voters) * 100, 1) : 0;

        return [
            'vote_data' => $vote_data,
            'statistics' => [
                'total_voters' => $total_voters,
                'total_votes' => $total_votes,
                'remaining_voters' => $remaining_voters,
                'participation' => $participation
            ]
        ];
    }
}