<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apoteker_model extends CI_Model
{
    public function getApoteker()
    {
        //ambil seluruh data siswa
        return  $this->db->get('data_pasien')->result_array();
    }
}
