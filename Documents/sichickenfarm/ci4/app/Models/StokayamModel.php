<?php

namespace App\Models;

use CodeIgniter\Model;

class StokayamModel extends Model
{
    protected $table = 'populasi';
    protected $allowedFields = ['jumlah'];

    public function getStokAyam($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}
