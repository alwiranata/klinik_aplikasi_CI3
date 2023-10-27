<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Registrasi_model', 'rm');
    }

    public function index()
    {

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {

            $data['title'] =  'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {

            $this->_login();
        }
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        //jika user ada

        if ($user) {
            //jika user aktif
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']

                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else if ($user['role_id'] == 2) {
                        redirect('dokter');
                    } else if ($user['role_id'] == 3) {
                        redirect('apoteker');
                    } else {
                        redirect('forbiden');
                    }
                } else {
                    $this->session->set_flashdata(
                        'auth_message',
                        '<div class="alert alert-danger" role="alert">
                         Password Tidak Sesuai
                        </div>'
                    );
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata(
                    'auth_message',
                    '<div class="alert alert-danger" role="alert">
                     Email Tidak Aktif
                    </div>'
                );
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata(
                'auth_message',
                '<div class="alert alert-danger" role="alert">
                 Email Belum Terdaftar
                </div>'
            );
            redirect('auth');
        }
    }


    public function registrasion()
    {

        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password to short!'
        ]);
        $this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {

            $data['title'] = ' Registrasi';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasion');
            $this->load->view('templates/auth_footer');
        } else {

            $this->rm->simpanUser();
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('password');

        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
