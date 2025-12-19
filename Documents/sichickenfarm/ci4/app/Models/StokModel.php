<?php

namespace App\Models;

use CodeIgniter\Model;

class StokModel extends Model
{
    protected $table = 'stok_pakan';
    protected $allowedFields = ['jumlah'];

    public function getStokPakan($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function hitungStokPakan()
    {
        $results = array();
        $db = \Config\Database::connect();
        $builder = $db->table('stok_pakan');
        $builder->selectSum('jumlah');
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $results = $query->getResultArray();
            return $results;
        } else {
            return 0;
        }
    }
    public function hitungAyam()
    {
        $results = array();
        $db = \Config\Database::connect();
        $builder = $db->table('populasi');
        $builder->selectSum('jumlah');
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $results = $query->getResultArray();
            return $results;
        } else {
            return 0;
        }
    }
}
