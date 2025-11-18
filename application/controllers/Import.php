<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Import extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
        
        // Check if admin is logged in
        if (!$this->session->userdata('logged_in') || $this->session->userdata('user_role') != 'admin') {
            redirect('auth');
        }
    }

    public function download_template() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set headers
        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'Nomor Telepon');
        $sheet->setCellValue('C1', 'Kelas');
        
        // Sample data
        $sheet->setCellValue('A2', 'Ahmad Fauzi');
        $sheet->setCellValue('B2', '081234567890');
        $sheet->setCellValue('C2', 'XII IPA 1');
        
        $sheet->setCellValue('A3', 'Siti Nurhaliza');
        $sheet->setCellValue('B3', '089876543210');
        $sheet->setCellValue('C3', 'XII IPS 2');
        
        $sheet->setCellValue('A4', 'Budi Santoso');
        $sheet->setCellValue('B4', '082345678901');
        $sheet->setCellValue('C4', 'XI IPA 3');
        
        // Style headers
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(15);
        
        $filename = 'template_data_pemilih.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function upload_data() {
        $response = array('status' => 'error', 'message' => 'Terjadi kesalahan');
        
        if (!empty($_FILES['excel_file']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'xlsx|xls';
            $config['max_size'] = 2048; // 2MB
            
            // Create upload directory if not exists
            if (!is_dir('./uploads/')) {
                mkdir('./uploads/', 0755, true);
            }
            
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('excel_file')) {
                $file_data = $this->upload->data();
                $file_path = $file_data['full_path'];
                
                $result = $this->process_excel($file_path);
                $response = $result;
                
                // Delete uploaded file
                unlink($file_path);
            } else {
                $response = array('status' => 'error', 'message' => $this->upload->display_errors());
            }
        }
        
        echo json_encode($response);
    }

    private function process_excel($file_path) {
        try {
            $spreadsheet = IOFactory::load($file_path);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            
            $success_count = 0;
            $error_count = 0;
            $errors = array();
            
            // Skip header row
            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];
                
                if (count($row) >= 3) {
                    $nama = trim($row[0]);
                    $nomor_telepon = trim($row[1]);
                    $kelas = trim($row[2]);
                    
                    // Validate data
                    if (empty($nama) || empty($nomor_telepon) || empty($kelas)) {
                        $error_count++;
                        $errors[] = "Baris " . ($i + 1) . ": Data tidak lengkap";
                        continue;
                    }
                    
                    // Generate default password (nomor telepon tanpa 0)
                    $default_password = ltrim($nomor_telepon, '0');
                    $hashed_password = password_hash($default_password, PASSWORD_DEFAULT);
                    
                    // Check if user already exists
                    $existing_user = $this->Auth_model->get_user_by_phone($nomor_telepon);
                    if ($existing_user) {
                        $error_count++;
                        $errors[] = "Baris " . ($i + 1) . ": Nomor telepon sudah terdaftar";
                        continue;
                    }
                    
                    // Insert user
                    $user_data = array(
                        'user_id' => $nomor_telepon,
                        'name' => $nama,
                        'kelas' => $kelas,
                        'password' => $hashed_password,
                        'default_password' => 1,
                        'has_voted' => 0
                    );
                    
                    if ($this->Auth_model->insert_user($user_data)) {
                        $success_count++;
                    } else {
                        $error_count++;
                        $errors[] = "Baris " . ($i + 1) . ": Gagal menyimpan data";
                    }
                }
            }
            
            $message = "Berhasil import $success_count data";
            if ($error_count > 0) {
                $message .= ", $error_count data gagal";
            }
            
            return array(
                'status' => 'success',
                'message' => $message,
                'success_count' => $success_count,
                'error_count' => $error_count,
                'errors' => $errors
            );
            
        } catch (Exception $e) {
            return array(
                'status' => 'error',
                'message' => 'Error membaca file Excel: ' . $e->getMessage()
            );
        }
    }
}