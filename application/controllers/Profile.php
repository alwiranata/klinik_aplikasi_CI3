<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->model('Profile_model', 'pm'); //Profile model

        is_logged_in();
    }
    public function profile()
    {
        $data['title'] = 'Data Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->pm->getAllUser();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambahProfile()
    {
        $data['title'] = 'Data Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->pm->getAllUser();



        $this->form_validation->set_rules('id', 'ID', 'required|trim|min_length[10]|is_unique[user.id]');
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Pasword', 'required|trim');
        $this->form_validation->set_rules('tugas', 'Tugas', 'required|trim');
        $this->form_validation->set_rules('role_id', 'User', 'required|trim');
        $this->form_validation->set_rules('is_active', 'Active', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('profile/index', $data);
            $this->load->view('templates/footer');
        } else {

            $this->pm->simpanProfile();

            $this->session->set_flashdata(
                'profile_message',
                '<div class="alert alert-success" role="alert">
                 Data Berhasil Ditambah
                </div>'
            );
            //arahkan ke halaman
            redirect('profile/profile');
        }
    }


    public function editProfile($id)
    {

        $data['title'] = 'Data Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->pm->getAllUser();

        // Load necessary libraries and models
        $this->load->library('upload');
        $this->load->model('pm');

        // Get the currently logged-in user's ID (you need to implement this part)
        // Implement your own logic to get the user ID

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // Form submission

            // Configuration for file upload



            if ($this->upload->do_upload('image')) {
                $old_image = $data['user']['image'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile' . $old_image);
                }
            } else {
                $config['upload_path'] = './assets/img/profile';
                $config['allowed_types'] = 'jpg|png|jpeg|';
                $config['max_size'] = 2048; // 2 MB

                // load library
                $this->load->library('upload', $config);

                //upload
                $this->upload->initialize($config);

                $data = array(
                    'id' => $this->input->post('id'),
                    'name' => $this->input->post('name'),
                    'image' => $this->input->post('image'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'tugas' => $this->input->post('tugas'),
                    'role_id' => $this->input->post('role_id'),
                    // Add other fields as needed
                );
            }

            // Update the user's profile in the database
            $result = $this->pm->updateProfile($id, $data);

            if ($result) {
                // Successful update, redirect or show a success message
                redirect('profile/profile'); // Adjust the URL as needed
            } else {
                // Update failed, handle the error
                $data['error'] = 'Profile update failed.';
                $this->load->view('profile', $data);
            }
        } else {
            // Display the edit profile form
            $this->load->view('profile');
        }
    }

    public function deleteProfile($id)
    {
        //delete data di model
        $this->pm->hapusProfile($id);

        //notif save
        $this->session->set_flashdata(
            'profile_message',
            '<div class="alert alert-danger" role="alert">
             Data Berhasil Dihapus!
            </div>'
        );
        //arahkan ke halaman
        redirect('profile/profile');
    }
}
