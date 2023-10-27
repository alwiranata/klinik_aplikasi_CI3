<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends CI_Model
{
    public function getAllUser()
    {
        // ambil seulurh data user
        return $this->db->get('user')->result_array();
    }
    public function getSubMenu()
    {
        $query = "SELECT`user`.*, `user_menu`.`menu`
                 FROM `user` JOIN `user_menu` 
                 ON `user`.`id` = `user_menu` .`id`
                 ";
        return $this->db->query($query)->result_array();
    }



    public function simpanProfile()
    {

        // tangkap value kedalam variabel
        $id       = $this->input->post('id');
        $name      = $this->input->post('name');
        $email      = $this->input->post('email');
        $pass      = $this->input->post('password');
        $tugas      = $this->input->post('tugas');
        $role_id      = $this->input->post('role_id');
        $is_active      = $this->input->post('is_active');
        // buat password hash
        $pw = password_hash($pass, PASSWORD_DEFAULT);

        // configurasi file upload
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['upload_path']   = './assets/img/profile';
        $config['max_size']      = '2048';

        // load library
        $this->load->library('upload', $config);

        //upload
        $this->upload->initialize($config);


        if (!$this->upload->do_upload('userfile')) {
            $data['error'] = $this->upload->display_errors();
            return FALSE;
        } else {

            $upload = $this->upload->data();

            // ambil data nama gambar
            $gambar = $upload['file_name'];

            $data = [
                'id' => $id,
                'name' => $name,
                'image'    => $gambar,
                'email'    => $email,
                'password' => $pw,
                'role_id' => $role_id,
                'tugas' => $tugas,
                'is_active' => $is_active,
                'date_created' => time()

            ];

            //lakukan insert data ke table user
        }
        $this->db->insert('user', $data);
    }

    public function updateProfile($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data); // Replace 'user_table_name' with your actual table name
        return $this->db->affected_rows(); // Return the number of affected rows
    }

    public function hapusProfile($id)
    {
        $this->db->delete('user', ['id' => $id]);
    }
}
