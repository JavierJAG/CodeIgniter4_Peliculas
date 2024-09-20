<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;

class Categoria extends BaseController
{

    public function index()
    {
        $categoriaModel = new CategoriaModel();
        return view("/dashboard/categorias/index", ['categoria' => $categoriaModel->findAll()]);
    }
    public function show($id)
    {
        $categoriaModel = new CategoriaModel();
        return view("/dashboard/categorias/show", ['categoria' => $categoriaModel->find($id)]);
    }
    public function new()
    {
        return view('/dashboard/categorias/new');
    }
    public function edit($id)
    {
        $categoriaModel = new CategoriaModel();
        return view('/dashboard/categorias/edit', ['categoria' => $categoriaModel->find($id)]);
    }
    public function update($id)
    {
        $categoriaModel = new CategoriaModel();
        $titulo = $this->request->getPost('titulo');
        $categoriaModel->update($id, ['titulo' => $titulo]);
        echo "Actualizado con éxito";
        return redirect()->to('/dashboard/categoria');
    }
    public function delete($id)
    {
        $categoriaModel = new CategoriaModel();
        $categoriaModel->delete($id);
        echo "Eliminada con éxito";
        return redirect()->back();
    }
    public function create()
    {
        $categoriaModel = new CategoriaModel();
        $titulo = $this->request->getPost('titulo');
        $categoriaModel->insert(['titulo' => $titulo]);
        return redirect()->to('/dashboard/categoria');
    }
}
