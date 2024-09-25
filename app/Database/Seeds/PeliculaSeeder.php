<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use App\Models\PeliculaModel;
use CodeIgniter\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    public function run()
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll();
        $peliculaModel->where('id >=',0)->delete();
        foreach($categorias as $c){
        for ($i = 1; $i < 5; $i++) {
            $peliculaModel->insert([
                'titulo' => 'titulo ' . $i,
                'categoria_id' => $c->id,
                'descripcion' => 'descripcion ' . $i
                
            ]);
        }}
    }
}
