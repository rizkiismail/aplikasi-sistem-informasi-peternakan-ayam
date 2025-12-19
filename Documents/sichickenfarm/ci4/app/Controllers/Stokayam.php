<?php

namespace App\Controllers;

use App\Models\StokayamModel;
use App\Models\StokModel;

class Stokayam extends BaseController
{
    protected $StokayamModel;
    protected $StokModel;

    public function __construct()
    {
        $this->StokayamModel = new StokayamModel();
        $this->StokModel = new StokModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Daftar Stok',
            'sisaayam' => $this->StokayamModel->getStokAyam(),
            'sisapakan' => $this->StokModel->getStokPakan()
        ];
        return view('stokayam/index', $data);
    }
    public function update($id)
    {
        $data = [
            'jumlah' => '0'
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('populasi');
        $builder->where('id', $id);
        $builder->update($data);
        return redirect()->to('/stokayam');
    }

    public function edit($id)
    {
        $data = [
            'sisaayam' => $this->StokayamModel->getStokAyam($id)
        ];
        return view('stokayam/index', $data);
    }

    public function updatepakan($id)
    {
        $data = [
            'jumlah' => '0'
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('stok_pakan');
        $builder->where('id', $id);
        $builder->update($data);
        return redirect()->to('/stokayam');
    }

    public function editpakan($id)
    {
        $data = [
            'sisapakan' => $this->StokModel->getStokPakan($id)
        ];
        return view('stokayam/index', $data);
    }
}
