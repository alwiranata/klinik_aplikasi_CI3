<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getMenu()
    {
        //ambil seluruh data siswa
        return $this->db->get('user_menu')->result_array();
    }

    public function getSubMenu()
    {
        $query = "SELECT`user_sub_menu`.*, `user_menu`.`menu`
                 FROM `user_sub_menu` JOIN `user_menu` 
                 ON `user_sub_menu`.`menu_id` = `user_menu` .`id`
                 ";
        return $this->db->query($query)->result_array();
    }
    public function simpanMenu()
    {
        //get data yang dikirim

        $menu = $this->input->post('menu');

        //satukan semua kedalam array data
        $data = [

            'menu'    => $menu,

        ];

        //eksekusi query insert data ke table
        $this->db->insert('user_menu', $data);
    }

    public function updateMenu($id)
    {
        //get data yang dikirim
        $id = $this->input->post('id');
        $menu = $this->input->post('menu');





        //satukan semua kedalam array data
        $data = [

            'menu'    => $menu,

        ];

        //eksekusi query insert data ke table
        $this->db->where('id', $id);
        $this->db->update('user_menu', $data);
    }
    public function hapusMenu($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
    }

    public function simpanSubMenu()
    {
        //get data yang dikirim

        $title = $this->input->post('title');
        $menu_id = $this->input->post('menu_id');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('is_active');

        //satukan semua kedalam array data
        $data = [

            'title'    => $title,
            'menu_id'    => $menu_id,
            'url'    => $url,
            'icon'    => $icon,
            'is_active'    => $is_active,

        ];

        //eksekusi query insert data ke table
        $this->db->insert('user_sub_menu', $data);
    }
    public function updateSubMenu($id)
    {
        //get data yang dikirim
        $id = $this->input->post('id');
        $menu_id = $this->input->post('menu_id');
        $title = $this->input->post('title');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');



        //satukan semua kedalam array data
        $data = [

            'menu_id'    => $menu_id,
            'title'    => $title,
            'url'    => $url,
            'icon'    => $icon,
            'is_active'    => '1'

        ];

        //eksekusi query insert data ke table
        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);
    }

    public function hapusSubMenu($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
    }
}
