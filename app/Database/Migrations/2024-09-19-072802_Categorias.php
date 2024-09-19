<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categorias extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id' =>
            [
                'type'=>'INT',
                'constraint'=>5,
                'unsigned'=>TRUE,
                'auto_increment'=> TRUE
            ],
            'titulo'=>[
                'type'=>'VARCHAR',
                'constraint'=>255
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('categorias');
    }

    public function down()
    {
        $this->forge->dropTable('categorias');
    }
}
