<?php

namespace App\Models;

use CodeIgniter\Model;

class PakanModel extends Model
{
    protected $table = 'pakan';
    protected $useTimestamps = true;
    protected $allowedFields = ['tanggal', 'jenis', 'jumlah'];

    public function getPakan($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function get_all_with_date($tgl_awal, $tgl_akhir)
    {
        return $this->db->query("SELECT * FROM pakan WHERE tanggal between '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal ASC");
    }
}
