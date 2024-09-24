<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unisgned' => true,
                'Auto_increment' => true
            ],
            'usuario' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,

            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true

            ],
            'contrasena' => [
                'type' => 'VARCHAR',
                'constraint' => 255

            ],
            'tipo' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'regular'],
                'default' => 'regular'
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}
