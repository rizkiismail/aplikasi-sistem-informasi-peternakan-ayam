<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pakan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' 	=> [
				'type'	=> 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'tanggal' => [
				'type' => 'DATE'
			],
			'jenis'	=> [
				'type'	=> 'VARCHAR',
				'constraint' => 255,
			],
			'jumlah' => [
				'type'	=> 'VARCHAR',
				'constraint' => 255,
			],
			'created_at' => [
				'type' 	=> 'DATETIME',
				'null'	=> TRUE
			],
			'updated_at' => [
				'type' 	=> 'DATETIME',
				'null'	=> TRUE
			]
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('pakan');
	}

	public function down()
	{
		$this->forge->dropTable('pakan');
	}
}
