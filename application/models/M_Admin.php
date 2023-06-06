<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Admin extends CI_Model
{

    public function getPelanggan()
    {
        return $this->db->get('pelanggan')->result();
    }

    public function getMonitoring($tahun, $bulan)
    {
        $this->db->select('pelanggan.nama, sensor.*');
        $this->db->from('pelanggan');
        $this->db->join('sensor', 'pelanggan.pelanggan_id = sensor.pelanggan_id', 'inner');

        $this->db->group_start();
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->group_end();

        $this->db->order_by('pelanggan.nama', 'asc');

        return $this->db->get()->result();
    }

    public function set($key)
    {
        $this->db->select('pelanggan.nama, sensor.*');
        $this->db->from('pelanggan');
        $this->db->join('sensor', 'pelanggan.pelanggan_id = sensor.pelanggan_id', 'inner');

        $this->db->where('pelanggan.pelanggan_id', $key);
        $this->db->where('YEAR(sensor.tanggal)', date('Y'));

        return $this->db->get()->result();
    }

    public function getTahunIni()
    {
        $this->db->select('YEAR(tanggal) as tahun');
        $this->db->order_by('tahun', 'desc');
        $this->db->limit(1);

        $data = $this->db->get('sensor')->row();
        return $data->tahun;
    }

    public function getBulanIni($tahun)
    {
        $this->db->select('MONTH(tanggal) as bulan');
        $this->db->where('YEAR(tanggal)', $tahun);

        $this->db->order_by('bulan', 'desc');
        $this->db->limit(1);

        $data = $this->db->get('sensor')->row();
        return $data->bulan;
    }

    public function getTahun()
    {
        $this->db->select('YEAR(tanggal) as tahun');
        $this->db->group_by('tahun');
        $this->db->order_by('tahun', 'desc');

        return $this->db->get('sensor')->result();
    }

    public function getInformasi()
    {
        return $this->db->get('informasi')->result();
    }
}

/* End of file M_Admin.php */
