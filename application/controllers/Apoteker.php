<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Apoteker extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Apoteker_model', 'am');
        is_logged_in();
    }
    public function index()
    {

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Profile Apoteker';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('apoteker/index', $data);
        $this->load->view('templates/footer');
    }

    public function dataPasien()
    {
        $data['pasien'] = $this->am->getApoteker();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Pasien';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('apoteker/data_pasien', $data);
        $this->load->view('templates/footer');
    }

    public function dataGejala()
    {
        $data['pasien'] = $this->am->getApoteker();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Pasien';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('apoteker/gejala', $data);
        $this->load->view('templates/style_gejala', $data);
        $this->load->view('templates/footer');
    }
}
