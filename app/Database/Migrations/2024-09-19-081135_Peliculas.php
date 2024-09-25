<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peliculas extends Migration
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
                'categoria_id'=>[
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,

                ],
                'titulo' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ],
                'descripcion' => [
                    'type' => 'TEXT',
                    'null' => TRUE
                ],
            ]
        );
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('categoria_id','categorias','id','CASCADE','CASCADE');
        $this->forge->createTable("peliculas");
    }

    public function down()
    {
        $this->forge->dropTable('peliculas');
    }
}
