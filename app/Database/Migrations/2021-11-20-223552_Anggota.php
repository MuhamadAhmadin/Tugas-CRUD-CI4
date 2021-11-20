<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Anggota extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'nik'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '25',
                'null'           => true,
			],
			'nama'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '129',
                'null'           => true,
			],
			'alamat'      => [
                'type'           => 'TEXT',
                'null'           => true,
			],
            'gender'       => [
                'type'           => 'CHAR',
                'constraint'     => '2',
                'null'           => true,
                'default'           => 'L',
            ],
			'organisasi_id' => [
                'type'           => 'INT',
                'constraint'     => '11',
			],
			'jabatan_id' => [
                'type'           => 'INT',
                'constraint'     => '11',
			],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
		]);

		// set Primary Key
		$this->forge->addKey('id', TRUE);

		$this->forge->createTable('anggotas', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('anggotas');
    }
}
