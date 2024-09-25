<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PeliculaImagen extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'pelicula_id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE
                ],
                'imagen_id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE
                ]
            ]
        );
        $this->forge->addForeignKey('pelicula_id', 'peliculas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('imagen_id', 'imagenes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pelicula_imagen');
    }

    public function down()
    {
        $this->forge->dropTable('pelicula_imagen');
    }
}
