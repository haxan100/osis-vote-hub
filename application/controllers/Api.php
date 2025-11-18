<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Vote_model');
    }

    public function vote_data() {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('user_role') != 'admin') {
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        $data = $this->Vote_model->get_vote_statistics();
        echo json_encode($data);
    }
}