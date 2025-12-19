<?php

namespace App\Models;

use CodeIgniter\Model;

class PanenModel extends Model
{
    protected $table = 'panen';
    protected $useTimestamps = true;
    protected $allowedFields = ['tanggal', 'nama', 'alamat', 'data_supir', 'jumlah', 'kg'];

    public function getPanen($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function get_all_with_date($tgl_awal, $tgl_akhir)
    {
        return $this->db->query("SELECT * FROM panen WHERE tanggal between '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal ASC");
    }
}
