<?php
defined('BASEPATH') or exit('No direct script access allowed');

class registrasi_model extends CI_Model
{
    public function getDataUser()
    {
        //ambil seluruh data siswa
        return $this->db->get('user')->result_array();
    }
    public function simpanUser()
    {
        //get data yang dikirim
        $role_id = $this->input->post('role_id');




        //satukan semua kedalam array data
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'role_id' => $role_id,
            'is_active' => '1',
            'date_created' => time()
        ];

        //eksekusi query insert data ke table
        $this->db->insert('user', $data);
    }
}
