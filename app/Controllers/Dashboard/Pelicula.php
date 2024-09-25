<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{

    public function index()
    {
        $peliculaModel = new PeliculaModel();
        $data = $peliculaModel->getPeliculaIndex();
        return view('/dashboard/peliculas/index', ['pelicula' => $data]);
    }
    public function show($id)
    {
        $peliculaModel = new PeliculaModel();

        return view('/dashboard/peliculas/show', ['pelicula' => $peliculaModel->find($id),'etiquetas'=>$peliculaModel->getEtiquetasById($id)]);
    }
    public function new()
    {
        $categoriaModel = new CategoriaModel();
        return view('/dashboard/peliculas/new', ['categorias' => $categoriaModel->find()]);
    }
    public function edit($id)
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();
        return view('/dashboard/peliculas/edit', ['pelicula' => $peliculaModel->find($id), 'categorias' => $categoriaModel->find()]);
    }
    public function create()
    {
        $peliculaModel = new PeliculaModel();
        if ($this->validate('peliculas')) {
            $titulo = $this->request->getPost('titulo');
            $descripcion = $this->request->getPost('descripcion');
            $categoria_id = $this->request->getPost('categoria_id');
            $peliculaModel->insert([
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'categoria_id' => $categoria_id
            ]);
            return redirect()->to('/dashboard/pelicula')->with('mensaje', 'Película creada correctamente');
        } else {
            return redirect()->back()->with('mensaje', $this->validator->listErrors());
        }
    }
    public function update($id)
    {
        $peliculaModel = new PeliculaModel();
        if ($this->validate('peliculas')) {
            $titulo = $this->request->getPost('titulo');
            $descripcion = $this->request->getPost('descripcion');
            $categoria_id = $this->request->getPost('categoria_id');
            $peliculaModel->update($id, [
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'categoria_id' => $categoria_id
            ]);
            session()->setFlashdata('mensaje', 'Película actualizada correctamente'); // Datos disponibles solo durante la siguiente solicitud, set() es permanente hasta que se cierre la sesion
            return redirect()->to('/dashboard/pelicula');
        } else {
            return redirect()->back()->with('mensaje', $this->validator->listErrors())->withInput();
        }
    }
    public function delete($id)
    {
        $peliculaModel = new PeliculaModel();

        $peliculaModel->delete($id);
        session()->setFlashdata('mensaje', 'Película eliminada correctamente');
        return redirect()->back();
    }

    public function etiquetas($id)
    {
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        $peliculaModel = new PeliculaModel();

        $etiquetas = [];
        if ($this->request->getGet('categoria_id')) {
            $etiquetas = $etiquetaModel
                ->where('categoria_id', $this->request->getGet('categoria_id'))
                ->find();
        }
        return view('/dashboard/peliculas/etiquetas', [
            'pelicula' => $peliculaModel->find($id),
            'categorias' => $categoriaModel->find(),
            'etiquetas' => $etiquetas
        ]);
    }
    public function etiquetas_post($id)
    {
        $peliculaEtiquetaModel = new PeliculaEtiquetaModel();
        $etiquetaId = $this->request->getPost('etiqueta_id');
        $peliculaId = $id;
        $peliculaEtiqueta = $peliculaEtiquetaModel->buscarEtiqueta($etiquetaId, $peliculaId);
        if(!$peliculaEtiqueta){
            $peliculaEtiquetaModel->insert([
                'pelicula_id'=> $peliculaId,
                'etiqueta_id'=>$etiquetaId
            ]);
        }
        return redirect()->back();
    }
    function etiqueta_delete($id,$etiquetaId) {
        $peliculaEtiqueta = new PeliculaEtiquetaModel();
        $peliculaEtiqueta->deleteEtiquetaById($id,$etiquetaId);
        return redirect()->back()->with('mensaje','Etiqueta eliminada');
    }
}
