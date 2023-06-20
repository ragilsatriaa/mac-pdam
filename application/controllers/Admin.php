<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
    }

    public function index()
    {
        $data = [
            'title'     => 'Dashboard',
            'sidebar'   => 'admin/sidebar',
            'page'      => 'admin/dashboard'
        ];

        $this->load->view('admin/index', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('pelanggan_id', 'ID Pelanggan', 'trim|required|is_unique[pelanggan.pelanggan_id]');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->index();
        } else {
            # code...
            $data = [
                'pelanggan_id'  => $this->input->post('pelanggan_id'),
                'nama'          => $this->input->post('nama'),
                'alamat'        => $this->input->post('alamat'),
                'status'        => $this->input->post('status'),
            ];

            $this->db->insert('pelanggan', $data);
        }
    }

    public function getRealtime()
    {
        $pelanggan = $this->db->get('pelanggan')->num_rows();

        $this->db->select('SUM(kubik) as totalAir');
        $kubik = $this->db->get('sensor')->row();

        $this->db->where('selenoid', 0);
        $pelangganOff = $this->db->get('pelanggan')->num_rows();

        echo json_encode([
            'totalPelanggan'    => $pelanggan,
            'totalAir'          => round($kubik->totalAir, 2),
            'totalPelangganOff' => $pelangganOff
        ]);
    }
}

/* End of file Admin.php */
