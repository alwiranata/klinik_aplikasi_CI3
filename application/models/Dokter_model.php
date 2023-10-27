<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter_model extends CI_Model
{
    public function getPasien()
    {
        //ambil seluruh data siswa
        return $this->db->get('data_pasien')->result_array();
    }

    public function simpanPasien()
    {
        //get data yang dikirim $nama = $this->input->post('nama');

        $nama = $this->input->post('nama');
        $gender = $this->input->post('gender');
        $umur = $this->input->post('umur');

        $berat = $this->input->post('berat');
        $gejala = $this->input->post('gejala');
        $hari = $this->input->post('hari');
        $tensi = $this->input->post('tensi');
        $resep = $this->input->post('resep');



        //satukan semua kedalam array data
        $data = [

            'nama'          => $nama,
            'gender'    => $gender,
            'umur'       => $umur,
            'tanggal'       =>  time(),
            'berat'   => $berat,
            'gejala'   => $gejala,
            'hari'   => $hari,
            'tensi'   => $tensi,
            'resep'   => $resep

        ];

        //eksekusi query insert data ke table
        $this->db->insert('data_pasien', $data);
    }
    public function updatePasien($id)
    {
        //get data yang dikirim
        $nama = $this->input->post('nama');
        $gender = $this->input->post('gender');
        $umur = $this->input->post('umur');
        $berat = $this->input->post('berat');
        $gejala = $this->input->post('gejala');
        $hari = $this->input->post('hari');
        $tensi = $this->input->post('tensi');
        $resep = $this->input->post('resep');


        //satukan semua kedalam array data
        $data = [
            'nama'          => $nama,
            'gender'    => $gender,
            'umur'       => $umur,
            'tanggal'       => time(),


        ];

        //eksekusi query insert data ke table
        $this->db->where('id', $id);
        $this->db->update('data_pasien', $data);
    }

    public function updateGejala($id)
    {
        //get data yang dikirim

        $berat = $this->input->post('berat');
        $gejala = $this->input->post('gejala');
        $hari = $this->input->post('hari');
        $tensi = $this->input->post('tensi');
        $resep = $this->input->post('resep');


        //satukan semua kedalam array data
        $data = [


            'berat'       => $berat,
            'gejala'       => $gejala,
            'hari'       => $hari,
            'tensi'       => $tensi,
            'resep'       => $resep,


        ];

        //eksekusi query insert data ke table
        $this->db->where('id', $id);
        $this->db->update('data_pasien', $data);
    }

    public function hapusPasien($id)
    {
        $this->db->delete('data_pasien', ['id' => $id]);
    }
}
