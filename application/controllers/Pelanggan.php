<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
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
            'title'     => 'Daftar Pelanggan',
            'sidebar'   => 'admin/sidebar',
            'page'      => 'admin/pelanggan',
            'pelanggan' => $this->admin->getPelanggan()
        ];

        $this->load->view('admin/index', $data);
    }

    public function add()
    {
        $data = [
            'pelanggan_id'  => $this->input->post('pelanggan_id'),
            'nama'          => $this->input->post('nama'),
            'alamat'        => $this->input->post('alamat'),
        ];

        $insert = $this->db->insert('pelanggan', $data);
        if ($insert) {
            $this->session->set_flashdata('toastr-success', 'Pelanggan berhasil ditambah!');
            redirect('pelanggan');
        } else {
            $this->session->set_flashdata('toastr-error', 'Pelanggan gagal ditambah!');
            redirect('pelanggan');
        }
    }

    public function delete($id)
    {
        $delete = $this->db->delete('pelanggan', ['id' => $id]);

        $this->db->delete('sensor', ['id' => $id]);

        if ($delete) {
            $this->session->set_flashdata('toastr-success', 'Pelanggan berhasil dihapus!');
            redirect('pelanggan');
        } else {
            $this->session->set_flashdata('toastr-error', 'Pelanggan gagal dihapus!');
            redirect('pelanggan');
        }
    }

    public function edit()
    {
        $data = [
            'pelanggan_id'  => $this->input->post('pelanggan_id'),
            'nama'          => $this->input->post('nama'),
            'alamat'        => $this->input->post('alamat'),
        ];


        $this->db->where('id', $this->input->post('id'));
        $update = $this->db->update('pelanggan', $data);
        if ($update) {
            $this->session->set_flashdata('toastr-success', 'Pelanggan berhasil diupdate!');
            redirect('pelanggan');
        } else {
            $this->session->set_flashdata('toastr-error', 'Pelanggan gagal diupdate!');
            redirect('pelanggan');
        }
    }

    public function editSelenoid($id, $selenoid)
    {
        $data = [
            'selenoid'  => $selenoid
        ];

        $this->db->where('id', $id);
        $update = $this->db->update('pelanggan', $data);

        if ($update) {
            $this->session->set_flashdata('toastr-success', 'Kran berhasil diupdate!');
            redirect('pelanggan', 'refresh');
        } else {
            $this->session->set_flashdata('toastr-success', 'Kran gagal diupdate!');
            redirect('pelanggan', 'refresh');
        }
    }
}

/* End of file Pelanggan.php */
