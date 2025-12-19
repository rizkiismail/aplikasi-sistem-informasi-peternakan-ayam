<?php

namespace App\Models;

use CodeIgniter\Model;

class BibitModel extends Model
{
    protected $table = 'bibit';
    protected $useTimestamps = true;
    protected $allowedFields = ['tanggal', 'jenis', 'jumlah'];

    public function getBibit($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function get_all_with_date($tgl_awal, $tgl_akhir)
    {
        return $this->db->query("SELECT * FROM bibit WHERE tanggal between '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal ASC");
    }
}
