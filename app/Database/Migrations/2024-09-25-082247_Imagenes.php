<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Imagenes extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'imagen' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                ],
                'extension' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                ],
                'data' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                ]
            ]
        );
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('imagenes');
    }

    public function down()
    {
        $this->forge->dropTable('imagenes');
    }
}
