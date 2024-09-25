<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use CodeIgniter\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categoriaModel = new CategoriaModel();
        $categoriaModel->where('id >=',0)->delete();
        for ($i = 1; $i < 20; $i++) {
            $categoriaModel->insert([
                'titulo' => 'titulo ' . $i
            ]);
        }
    }
}
