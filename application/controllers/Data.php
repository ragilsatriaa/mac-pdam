<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    public function save()
    {
        $pelanggan_id = $this->input->get('pelanggan_id');
        $totalLitres = $this->input->get('totalLitres');
        $kubik = $this->input->get('kubik');
        $totalBiaya = $this->input->get('totalBiaya');

        $data = [
            'totalLitres' => $totalLitres,
            'kubik'       => $kubik,
            'totalBiaya'  => $totalBiaya,
        ];

        $this->db->where([
            'pelanggan_id'   => $pelanggan_id,
            'YEAR(tanggal)'  => date('Y'),
            'MONTH(tanggal)' => date('m')
        ]);
        $update = $this->db->update('sensor', $data);

        if ($update) {
            echo 'Data berhasil diupdate';
        } else {
            echo 'Data gagal diupdate';
        }
    }

    public function getLastData()
    {
        $pelanggan_id = $this->input->get('pelanggan_id');

        $this->db->where([
            'pelanggan_id' => $pelanggan_id,
            'YEAR(tanggal)' => date('Y'),
            'MONTH(tanggal)' => date('m')
        ]);

        $data = $this->db->get('sensor')->row();

        if (!$data) {
            $sensor = [
                'pelanggan_id' => $pelanggan_id,
                'tanggal'      => date('Y-m-d'),
                'totalLitres'  => 0,
                'kubik'        => 0,
                'totalBiaya'   => 0,
            ];

            $this->db->insert('sensor', $sensor);

            $respon = '0#0#0#ok';
        } else {
            $respon = $data->totalLitres . '#' . $data->kubik . '#' . $data->totalBiaya . '#ok';
        }

        echo $respon;
    }

    public function settingSelenoid()
    {
        $pelanggan_id = $this->input->get('pelanggan_id');

        $this->db->where('pelanggan_id', $pelanggan_id);
        $data = $this->db->get('pelanggan')->row();

        echo $data->selenoid . '#OK';
    }
}

/* End of file Data.php */
