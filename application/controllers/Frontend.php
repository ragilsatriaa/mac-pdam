<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Admin', 'admin');
    }

    public function index()
    {
        $key = $this->input->post('key', true);

        $data = [
            'title' => 'PDAM',
            'pelanggan'  => $this->admin->set($key),
            'informasi' => $this->admin->getInformasi()
        ];

        $this->load->view('frontend/index', $data);
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
        $pdf->Cell(130, 8, 'BUKTI TAGIHAN PEMBAYARAN REKENING AIR', 0, 1, 'C');

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

        $pdf->Cell(30, 10, 'Kubik', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0, 'C');
        $pdf->Cell(50, 10, $data->kubik, 0, 1);

        $pdf->Ln(4);

        $pdf->Cell(30, 10, 'Biaya', 0, 0);
        $pdf->Cell(5, 10, ':', 0, 0, 'C');
        $pdf->Cell(50, 10, 'Rp. ' . number_format($data->totalBiaya, 0, ',', '.'), 0, 1);

        $pdf->Ln(10);

        $pdf->Cell(100, 10, '', 0, 0);
        $pdf->Cell(20, 10, 'KANTOR PDAM KOTA TEGAL 2023', 0, 1);

        $pdf->Output('E_Struk.pdf', 'I');
    }
}

/* End of file Frontend.php */
