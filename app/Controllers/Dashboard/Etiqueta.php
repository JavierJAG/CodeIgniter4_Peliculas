<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;


class Etiqueta extends BaseController
{

    public function index()
    {
        $etiquetaModel = new EtiquetaModel();
        $data = $etiquetaModel->getEtiquetaIndex();
        return view('/dashboard/etiquetas/index', ['etiqueta' => $data]);
    }
    public function show($id)
    {
        $etiquetaModel = new EtiquetaModel();

        return view('/dashboard/etiquetas/show', ['etiqueta' => $etiquetaModel->find($id)]);
    }
    public function new()
    {
        $categoriaModel = new CategoriaModel();
        return view('/dashboard/etiquetas/new', ['categorias' => $categoriaModel->find()]);
    }
    public function edit($id)
    {
        $etiquetaModel = new EtiquetaModel();
        $categoriaModel = new CategoriaModel();
        return view('/dashboard/etiquetas/edit', ['etiqueta' => $etiquetaModel->find($id), 'categorias' => $categoriaModel->find()]);
    }
    public function create()
    {
        $etiquetaModel = new EtiquetaModel();
        if ($this->validate('etiquetas')) {
            $titulo = $this->request->getPost('titulo');
            $categoria_id = $this->request->getPost('categoria_id');
            $etiquetaModel->insert([
                'titulo' => $titulo,
                'categoria_id' => $categoria_id
            ]);
            return redirect()->to('/dashboard/etiqueta')->with('mensaje', 'Etiqueta creada correctamente');
        } else {
            return redirect()->back()->with('mensaje', $this->validator->listErrors());
        }
    }
    public function update($id)
    {
        $etiquetaModel = new EtiquetaModel();
        if ($this->validate('etiquetas')) {
            $titulo = $this->request->getPost('titulo');
            $categoria_id = $this->request->getPost('categoria_id');
            $etiquetaModel->update($id, [
                'titulo' => $titulo,
                'categoria_id' => $categoria_id
            ]);
            session()->setFlashdata('mensaje', 'Etiqueta actualizada correctamente'); // Datos disponibles solo durante la siguiente solicitud, set() es permanente hasta que se cierre la sesion
            return redirect()->to('/dashboard/etiqueta');
        } else {
            return redirect()->back()->with('mensaje', $this->validator->listErrors())->withInput();
        }
    }
    public function delete($id)
    {
        $etiquetaModel = new EtiquetaModel();

        $etiquetaModel->delete($id);
        session()->setFlashdata('mensaje', 'Etiqueta eliminada correctamente');
        return redirect()->back();
    }
}
