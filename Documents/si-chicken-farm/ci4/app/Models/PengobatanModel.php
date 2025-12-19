<?php

namespace App\Models;

use CodeIgniter\Model;

class PengobatanModel extends Model
{
    protected $table = 'pengobatan';
    protected $useTimestamps = true;
    protected $allowedFields = ['tanggal', 'jenis', 'jumlah'];

    public function getPengobatan($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getJenisObat()
    {
        $results = array();
        $db = \Config\Database::connect();
        $builder = $db->table('obat');
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $results = $query->getResultArray();
            return $results;
        } else {
            return 0;
        }
    }

    public function get_all_with_date($tgl_awal, $tgl_akhir)
    {
        return $this->db->query("SELECT * FROM pengobatan WHERE tanggal between '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal ASC");
    }
}
