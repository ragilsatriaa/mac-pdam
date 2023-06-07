<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!empty($this->session->userdata('log_admin'))) {
            if ($this->uri->segment(2) != 'logout') {
                $this->session->set_flashdata('toastr-error', 'Anda sudah login !');
                redirect('admin');
            }
        }
        $this->load->model('M_Login', 'login');
    }

    public function index()
    {
        $data = [
            'title'     => 'Login',
            'page'      => 'auth/login'
        ];

        $this->load->view('auth/index', $data);
    }

    public function proses()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('toastr-error', validation_errors());
            redirect('auth');
        } else {
            # code...
            $username   = $this->input->post('username');
            $password   = $this->input->post('password');

            $user = $this->login->cek($username, $password);

            if ($user == 'admin') {
                $this->session->set_flashdata('toastr-success', 'Login berhasil');
                redirect('admin', 'refresh');
            } else {
                $this->session->set_flashdata('msg-error', '<div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                ' . $user . '
                </div>');
                redirect('auth', 'refresh');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy($this->session->userdata('log_admin'));
        $this->session->set_flashdata('toastr-success', 'Logout berhasil');
        redirect('auth', 'refresh');
    }
}

/* End of file Auth.php */
