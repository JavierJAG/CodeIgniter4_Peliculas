<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use CodeIgniter\Database\Seeder;

class EtiquetaSeeder extends Seeder
{
    public function run()
    {
        $etiquetaModel = new EtiquetaModel();
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll();
        $etiquetaModel->where('id >=', 0)->delete();
        foreach ($categorias as $c) {
            for ($i = 1; $i < 5; $i++) {
                $etiquetaModel->insert([
                    'titulo' => 'Tag ' . $i .' '. $c->titulo,
                    'categoria_id' => $c->id,
                    
                ]);
            }
        }
    }
}
