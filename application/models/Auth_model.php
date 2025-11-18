<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function validate_user($user_id, $password, $role) {
        // Data dummy untuk testing
        $valid_users = array(
            'pemilih' => array(
                array('id' => '081234567890', 'password' => 'pemilih123', 'name' => 'Ahmad Fauzi'),
                array('id' => '089876543210', 'password' => 'pemilih123', 'name' => 'Siti Nurhaliza'),
                array('id' => '082345678901', 'password' => 'pemilih123', 'name' => 'Budi Santoso')
            ),
            'admin' => array(
                array('id' => 'admin', 'password' => 'admin123', 'name' => 'Administrator')
            ),
            'calon' => array(
                array('id' => 'calon1', 'password' => 'calon123', 'name' => 'Ahmad Rizki', 'candidate_number' => 1),
                array('id' => 'calon2', 'password' => 'calon123', 'name' => 'Siti Aisyah', 'candidate_number' => 2),
                array('id' => 'calon3', 'password' => 'calon123', 'name' => 'Muhammad Farhan', 'candidate_number' => 3)
            )
        );

        if (isset($valid_users[$role])) {
            foreach ($valid_users[$role] as $user) {
                if ($user['id'] == $user_id && $user['password'] == $password) {
                    return $user;
                }
            }
        }

        return false;
    }
}