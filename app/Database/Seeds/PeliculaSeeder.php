<?php

namespace App\Database\Seeds;


use App\Models\PeliculaModel;
use CodeIgniter\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    public function run()
    {
        $peliculaModel = new PeliculaModel();
        $peliculaModel->where('id >=',1)->delete();
        for ($i = 0; $i < 20; $i++) {
            $peliculaModel->insert([
                'titulo' => 'titulo ' . $i,
                'descripcion' => 'descripcion ' . $i
            ]);
        }
    }
}
