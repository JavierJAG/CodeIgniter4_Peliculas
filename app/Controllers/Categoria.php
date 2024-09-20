<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class Categoria extends BaseController
{

    public function index()
    {
        $categoriaModel = new CategoriaModel();
        return view("/categorias/index", ['categoria' => $categoriaModel->findAll()]);
    }
    public function show($id)
    {
        $categoriaModel = new CategoriaModel();
        return view("/categorias/show", ['categoria' => $categoriaModel->find($id)]);
    }
    public function new()
    {
        return view('/categorias/new');
    }
    public function edit($id)
    {
        $categoriaModel = new CategoriaModel();
        return view('/categorias/edit', ['categoria' => $categoriaModel->find($id)]);
    }
    public function update($id)
    {
        $categoriaModel = new CategoriaModel();
        $titulo = $this->request->getPost('titulo');
        $categoriaModel->update($id, ['titulo' => $titulo]);
        echo "Actualizado con éxito";
    }
    public function delete($id)
    {
        $categoriaModel = new CategoriaModel();
        $categoriaModel->delete($id);
        echo "Eliminada con éxito";
    }
    public function create()
    {
        $categoriaModel = new CategoriaModel();
        $titulo = $this->request->getPost('titulo');
        $categoriaModel->insert(['titulo' => $titulo]);
        echo "Añadida con éxito";
    }
}
