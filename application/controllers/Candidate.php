<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Candidate_model');
        $this->check_admin();
    }

    private function check_admin() {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('user_role') != 'admin') {
            redirect('auth');
        }
    }

    public function save() {
        $candidate_id = $this->input->post('candidate_id');
        $candidate_number = $this->input->post('candidate_number');
        $ketua_name = $this->input->post('ketua_name');
        $wakil_name = $this->input->post('wakil_name');
        $vision = $this->input->post('vision');
        $mission = $this->input->post('mission');

        // Upload photos
        $ketua_photo = $this->upload_photo('ketua_photo', $candidate_number ?: 'new', 'ketua');
        $wakil_photo = $this->upload_photo('wakil_photo', $candidate_number ?: 'new', 'wakil');
        $couple_photo = $this->upload_photo('couple_photo', $candidate_number ?: 'new', 'couple');

        $data = array(
            'ketua_name' => $ketua_name,
            'wakil_name' => $wakil_name,
            'vision' => $vision,
            'mission' => $mission
        );

        if ($ketua_photo) $data['ketua_photo'] = $ketua_photo;
        if ($wakil_photo) $data['wakil_photo'] = $wakil_photo;
        if ($couple_photo) $data['couple_photo'] = $couple_photo;

        if ($candidate_id) {
            // Update
            $this->Candidate_model->update_candidate($candidate_id, $data);
            $message = 'Kandidat berhasil diperbarui!';
        } else {
            // Insert
            $data['candidate_number'] = $candidate_number;
            $this->Candidate_model->insert_candidate($data);
            $message = 'Kandidat berhasil ditambahkan!';
        }

        echo json_encode(array('status' => 'success', 'message' => $message));
    }

    private function upload_photo($field_name, $candidate_number, $type) {
        if (!empty($_FILES[$field_name]['name'])) {
            $config['upload_path'] = './candidates/foto/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = $candidate_number . '_' . $type;
            $config['overwrite'] = TRUE;
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload($field_name)) {
                $upload_data = $this->upload->data();
                return 'candidates/foto/' . $upload_data['file_name'];
            }
        }
        return false;
    }
}