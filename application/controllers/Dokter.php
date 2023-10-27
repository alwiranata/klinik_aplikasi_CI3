<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dokter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Dokter_model', 'dm');
        is_logged_in();
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Profile Dokter';
        $data['pasien'] = $this->dm->getPasien();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('dokter/index', $data);
        $this->load->view('templates/footer');
    }
    public function dataPasien()
    {
        $data['pasien'] = $this->dm->getPasien();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Data Pasien';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('dokter/data_pasien', $data);
        $this->load->view('templates/footer');
    }
    public function gejala()
    {
        $data['title'] = 'Data Pasien';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pasien'] = $this->dm->getPasien();
        $data['title_1'] = 'Gejala';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('dokter/gejala', $data);
        $this->load->view('templates/style_gejala');
        $this->load->view('templates/footer');
    }

    public function tambahDataPasien()
    {
        $data['title'] = 'Data Pasien';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pasien'] = $this->dm->getPasien();
        //CEK VALIDASI DATA

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
        $this->form_validation->set_rules('umur', 'Umur', 'required|trim');
        $this->form_validation->set_rules('berat', 'Berat', 'required|trim');
        $this->form_validation->set_rules('gejala', 'Gejala', 'required|trim');
        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');
        $this->form_validation->set_rules('tensi', 'Tensi', 'required|trim');
        $this->form_validation->set_rules('resep', 'Resep', 'required|trim');

        //validasi_data
        if ($this->form_validation->run() == FALSE) {

            //Jika ada data yang tidak valid
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('dokter/data_pasien', $data);
            $this->load->view('templates/footer');
        } else {
            //Jika Seluruh data Valid
            $this->dm->simpanPasien();

            $this->session->set_flashdata(
                'pasien_message',
                '<div class="alert alert-success" role="alert">
                 Data Berhasil Disimpan
                </div>'
            );
            //arahkan ke halaman
            redirect('dokter/dataPasien');
        }
    }
    public function editGejala($id)
    {
        $this->form_validation->set_rules('id', 'Id', 'required|trim');
        $this->form_validation->set_rules('berat', 'Berat', 'required|trim');
        $this->form_validation->set_rules('gejala', 'Gejala', 'required|trim');
        $this->form_validation->set_rules('hari', 'hari', 'required|trim');
        $this->form_validation->set_rules('tensi', 'Tensi', 'required|trim');
        $this->form_validation->set_rules('resep', 'Resep', 'required|trim');

        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Data Pasien';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['pasien'] = $this->dm->getPasien();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('dokter/gejala', $data);
            $this->load->view('templates/style_gejala');
            $this->load->view('templates/footer');
        } else {
            //arahkan ke Admin Model
            $this->dm->updateGejala($id);

            //notif save
            $this->session->set_flashdata(
                'gejala_message',
                '<div class="alert alert-success" role="alert">
                 Data Berhasil Diperbarui!
            </div>'
            );

            //arahkan ke halaman
            redirect('dokter/gejala');
        }
    }

    public function editPasien($id)
    {

        //CEK VALIDASI DATA
        $this->form_validation->set_rules('id', 'Id', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim');


        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Data Pasien';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['pasien'] = $this->dm->getPasien();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('dokter/data_pasien', $data);
            $this->load->view('templates/footer');
        } else {
            //arahkan ke Admin Model
            $this->dm->updatePasien($id);

            //notif save
            $this->session->set_flashdata(
                'pasien_message',
                '<div class="alert alert-success" role="alert">
                 Data Berhasil Diperbarui!
            </div>'
            );

            //arahkan ke halaman
            redirect('dokter/dataPasien');
        }
    }

    public function hapusPasien($id)
    {
        //delete data di model
        $this->dm->hapusPasien($id);

        //notif save
        $this->session->set_flashdata(
            'pasien_message',
            '<div class="alert alert-danger" role="alert">
             Data Berhasil Dihapus!
            </div>'
        );
        //arahkan ke halaman
        redirect('dokter/dataPasien');
    }
}
