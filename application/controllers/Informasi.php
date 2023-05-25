<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('log_admin'))) {
            $this->session->set_flashdata('toastr-eror', 'Anda Belum Login');
            redirect('auth', 'refresh');
        }

        $this->db->where('id', $this->session->userdata('id'));
        $this->dt_admin = $this->db->get('admin')->row();

        $this->load->model('M_Admin', 'admin');
    }

    public function index()
    {
        $data = [
            'title'     => 'Informasi',
            'sidebar'   => 'admin/sidebar',
            'page'      => 'admin/informasi',
            'informasi' => $this->admin->getInformasi()
        ];

        $this->load->view('admin/index', $data);
    }

    public function add()
    {
        $data = [
            'perihal'  => $this->input->post('perihal'),
            'konten' => $this->input->post('konten'),
        ];

        $insert = $this->db->insert('informasi', $data);
        if ($insert) {
            $this->session->set_flashdata('toastr-success', 'informasi berhasil ditambah!');
            redirect('informasi');
        } else {
            $this->session->set_flashdata('toastr-error', 'informasi gagal ditambah!');
            redirect('informasi');
        }
    }

    public function delete($id)
    {
        $delete = $this->db->delete('informasi', ['id' => $id]);

        $this->db->delete('informasi', ['id' => $id]);

        if ($delete) {
            $this->session->set_flashdata('toastr-success', 'informasi berhasil dihapus!');
            redirect('informasi');
        } else {
            $this->session->set_flashdata('toastr-error', 'informasi gagal dihapus!');
            redirect('informasi');
        }
    }

    public function edit()
    {
        $data = [
            'perihal'   => $this->input->post('perihal'),
            'konten'    => $this->input->post('konten'),
        ];


        $this->db->where('id', $this->input->post('id'));
        $update = $this->db->update('informasi', $data);
        if ($update) {
            $this->session->set_flashdata('toastr-success', 'informasi berhasil diupdate!');
            redirect('informasi');
        } else {
            $this->session->set_flashdata('toastr-error', 'informasi gagal diupdate!');
            redirect('informasi');
        }
    }
}

/* End of file Pelanggan.php */
