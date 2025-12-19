<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class PakanSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'tanggal' => '2021-06-14',
            'jenis'   => 'sicepat',
            'jumlah'  => '30',
            'created_at' => Time::now(),
            'updated_at' => Time::now()
        ];

        //$this->db->query(
        //"INSERT INTO pakan (tanggal, jenis, jumlah, created_at, updated_at) VALUES(:tanggal:, :jenis:, :jumlah:, :created_at:, :updated_at:)",
        //$data
        //);

        //$this->db->table('pakan')->insert($data);
    }
}
