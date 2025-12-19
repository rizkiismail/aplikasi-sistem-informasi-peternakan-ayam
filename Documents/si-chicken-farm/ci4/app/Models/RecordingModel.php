<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordingModel extends Model
{
    protected $table = 'recording';
    protected $useTimestamps = true;
    protected $allowedFields = ['umur', 'tanggal', 'mati', 'habis_pakan'];

    public function getRecording($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function get_all_with_date($tgl_awal, $tgl_akhir)
    {
        return $this->db->query("SELECT * FROM recording WHERE tanggal between '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal ASC");
    }
}
