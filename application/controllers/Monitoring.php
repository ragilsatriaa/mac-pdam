<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitoring extends CI_Controller
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
        $th_ini = $this->uri->segment(2);
        $bln_ini = $this->uri->segment(3);

        if (!$th_ini) {
            $th_ini = $this->admin->getTahunIni();
        }
        if (!$bln_ini) {
            $bln_ini = $this->admin->getBulanIni($th_ini);
        }

        $data = [
            'title'   => 'Monitoring PDAM',
            'sidebar' => 'admin/sidebar',
            'page'    => 'admin/monitoring',
            'tahun'   => $this->admin->getTahun(),
            'data'    => $this->admin->getMonitoring($th_ini, $bln_ini),
            'th_ini'  => $th_ini,
            'bln_ini' => $bln_ini
        ];

        $this->load->view('admin/index', $data);
    }

    public function cetak($id)
    {
        $this->db->select('sensor.*, pelanggan.nama');
        $this->db->join('pelanggan', 'pelanggan.pelanggan_id = sensor.pelanggan_id', 'inner');

        $this->db->where('sensor.id', $id);
        $data = $this->db->get('sensor')->row();

        if (!$data) {
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }

        $pdf = new FPDF('p', 'mm', 'A4');

        $pdf->AddPage();

        $pdf->SetAutoPageBreak(TRUE, 1);

        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(30, 8, '', 0, 0);
        $pdf->Cell(130, 8, 'LAPORAN PENGGUNAAN METERAN AIR CERDAS', 0, 1, 'C');

        $pdf->Ln(10);

        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(30, 10, 'ID Pelanggan', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0, 'C');
        $pdf->Cell(50, 10, $data->pelanggan_id, 0, 1);

        $pdf->Ln(4);

        $pdf->Cell(30, 10, 'Nama', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0, 'C');
        $pdf->Cell(50, 10, $data->nama, 0, 1);

        $pdf->Ln(4);

        $pdf->Cell(30, 10, 'Total Penggunaan', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0, 'C');
        $pdf->Cell(50, 10, $data->kubik . ' m3', 0, 1);

        $pdf->Ln(4);

        $pdf->Cell(30, 10, 'Total Biaya', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0, 'C');
        $pdf->Cell(50, 10, 'Rp. ' . number_format($data->totalBiaya, 0, ',', '.'), 0, 1);

        $pdf->Ln(10);

        $pdf->Cell(100, 10, '', 0, 0);
        $pdf->Cell(20, 10, 'PDAM KABUPATEN TEGAL', 0, 1);

        $pdf->Output('E_Struk.pdf', 'I');
    }
}

/* End of file Pelanggan.php */
