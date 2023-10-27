<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->model('Admin_model', 'am'); //Admin model
        $this->load->model('Profile_model', 'pm');


        //Admin model

        is_logged_in();
    }
    public function index()
    {
        $data['profile'] = $this->pm->getAllUser();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Admin';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }


    public function role()
    {

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Role';
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function tambahRole()
    {
        $data['title'] = 'Tambah Data Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        //CEK VALIDASI DATA

        $this->form_validation->set_rules('role', 'Role', 'required|trim');


        //validasi_data
        if ($this->form_validation->run() == FALSE) {

            //Jika ada data yang tidak valid
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            //Jika Seluruh data Valid
            $this->am->simpanRole();

            $this->session->set_flashdata(
                'role_message',
                '<div class="alert alert-success" role="alert">
                 Data Berhasil Disimpan
                </div>'
            );
            //arahkan ke halaman
            redirect('admin/role');
        }
    }


    public function editRole($id)
    {

        //CEK VALIDASI DATA
        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Edit Role';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['role'] = $this->db->get_where('user_role', ['id' => $id])->row_array();
            $data['role'] = $this->db->get('user_role')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            //arahkan ke Admin Model
            $this->am->updateRole($id);

            //notif save 
            $this->session->set_flashdata(
                'role_message',
                '<div class="alert alert-success" role="alert">
                 Data Berhasil Diperbarui!
            </div>'
            );

            //arahkan ke halaman
            redirect('admin/role');
        }
    }

    public function accessRole($role_id)
    {

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Akses';
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('admin/role_access', $data);
        $this->load->view('templates/footer');
    }

    public function hapusRole($id)
    {
        //delete data di model
        $this->am->hapusRole($id);

        //notif save
        $this->session->set_flashdata(
            'role_message',
            '<div class="alert alert-danger" role="alert">
             Data Berhasil Dihapus!
            </div>'
        );
        //arahkan ke halaman
        redirect('admin/role');
    }

    public function changeAccess()
    {

        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata(
            'role_message',
            '<div class="alert alert-success" role="alert">
             Akses Ditukar!
            </div>'
        );
    }
}
