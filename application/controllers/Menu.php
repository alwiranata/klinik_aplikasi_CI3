<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Menu extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->model('Menu_model', 'mm'); //buku model

        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->mm->getMenu();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambahMenu()
    {
        $data['title'] = 'Tambah Menu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->mm->getMenu();
        //CEK VALIDASI DATA

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        //validasi_data
        if ($this->form_validation->run() == FALSE) {

            //Jika ada data yang tidak valid
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            //Jika Seluruh data Valid
            $this->mm->simpanMenu();
            $this->session->set_flashdata(
                'menu_message',
                '<div class="alert alert-success" role="alert">
                 Data Berhasil Disimpan
                </div>'
            );
            //arahkan ke halaman
            redirect('menu/index');
        }
    }
    public function editMenu($id)
    {

        //CEK VALIDASI DATA
        $this->form_validation->set_rules('id', 'Id', 'required|trim');
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');

        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Menu Management';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['pasien'] = $this->mm->getMenu();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            //arahkan ke Admin Model
            $this->mm->updateMenu($id);

            //notif save
            $this->session->set_flashdata(
                'menu_message',
                '<div class="alert alert-success" role="alert">
                 Data Berhasil Diperbarui!
            </div>'
            );

            //arahkan ke halaman
            redirect('menu/index');
        }
    }



    public function hapusMenu($id)
    {
        //delete data di model
        $this->mm->hapusMenu($id);

        //notif save
        $this->session->set_flashdata(
            'menu_message',
            '<div class="alert alert-danger" role="alert">
             Data Berhasil Dihapus!
            </div>'
        );
        //arahkan ke halaman
        redirect('menu/index');
    }


    public function subMenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] =   $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('menu/submenu', $data);
        $this->load->view('templates/footer');
    }

    public function tambahSubMenu()
    {
        $data['title'] = 'Tambah Submenu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['subMenu'] = $this->mm->getSubMenu();
        $data['menu'] =   $this->db->get('user_menu')->result_array();
        //CEK VALIDASI DATA

        $this->form_validation->set_rules('title', 'Title', 'required');

        $this->form_validation->set_rules('menu_id', 'Menu', 'required');

        $this->form_validation->set_rules('url', 'URl', 'required');

        $this->form_validation->set_rules('icon', 'Icon', 'required');



        //validasi_data
        if ($this->form_validation->run() == FALSE) {

            //Jika ada data yang tidak valid
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('menu/subMenu', $data);
            $this->load->view('templates/footer');
        } else {
            //Jika Seluruh data Valid
            $this->mm->simpanSubMenu();
            $this->session->set_flashdata(
                'sub_menu_message',
                '<div class="alert alert-success" role="alert">
                 Data Berhasil Disimpan
                </div>'
            );
            //arahkan ke halaman
            redirect('menu/subMenu');
        }
    }

    public function editSubMenu($id)
    {

        //CEK VALIDASI DATA
        $this->form_validation->set_rules('id', 'Id', 'required|trim');
        $this->form_validation->set_rules('menu_id', 'Menu_Id', 'required|trim');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('url', 'Url', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');


        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Sub Menu Management';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['subMenu'] = $this->mm->getSubMenu();
            $data['menu'] =   $this->db->get('user_menu')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('menu/subMenu', $data);
            $this->load->view('templates/footer');
        } else {
            //arahkan ke Admin Model
            $this->mm->updateSubMenu($id);

            //notif save
            $this->session->set_flashdata(
                'sub_menu_message',
                '<div class="alert alert-success" role="alert">
                 Data Berhasil Diperbarui!
            </div>'
            );

            //arahkan ke halaman
            redirect('menu/subMenu');
        }
    }

    public function hapusSubMenu($id)
    {
        //delete data di model
        $this->mm->hapusSubMenu($id);

        //notif save
        $this->session->set_flashdata(
            'sub_menu_message',
            '<div class="alert alert-danger" role="alert">
             Data Berhasil Dihapus!
            </div>'
        );
        //arahkan ke halaman
        redirect('menu/subMenu');
    }
}
