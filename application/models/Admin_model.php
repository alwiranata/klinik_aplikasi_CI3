<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getAllUser()
    {
        // ambil seulurh data user
        return $this->db->get('user')->result_array();
    }
    public function getAllUserRole()
    {
        // ambil seulurh data user
        return $this->db->get('user_role')->result_array();
    }



    public function simpanRole()
    {

        //get data yang dikirim
        $role = $this->input->post('role');



        //satukan semua kedalam array data
        $data = [

            'role'          => $role

        ];

        //eksekusi query insert data ke table
        $this->db->insert('user_role', $data);
    }

    public function updateRole($id)
    {

        //get data yang dikirim
        $role = $this->input->post('role');



        //satukan semua kedalam array data
        $data = [

            'role' => $role

        ];

        //eksekusi query insert data ke table
        $this->db->where('id', $id);
        $this->db->update('user_role', $data);
    }

    public function hapusRole($id)
    {
        $this->db->delete('user_role', ['id' => $id]);
    }
}
