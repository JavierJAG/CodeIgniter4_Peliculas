<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{

    public function index()
    {
        $peliculaModel = new PeliculaModel();

        return view("/dashboard/peliculas/index", ['pelicula' => $peliculaModel->findAll()]);
    }
    public function show($id)
    {
        $peliculaModel = new PeliculaModel();

        return view('/dashboard/peliculas/show',['pelicula'=>$peliculaModel->find($id)]);
    }
    public function new()
    {
        return view('/dashboard/peliculas/new');
    }
    public function edit($id)
    {
        $peliculaModel = new PeliculaModel();

        return view('/dashboard/peliculas/edit',['pelicula'=> $peliculaModel->find($id)]);
    }
    public function create()
    {
        $peliculaModel = new PeliculaModel();
        $titulo = $this->request->getPost('titulo');
        $descripcion = $this->request->getPost('descripcion');
        $peliculaModel->insert([
            'titulo'=>$titulo,
            'descripcion'=>$descripcion
        ]);
        return redirect()->to('/dashboard/pelicula');
    }
    public function update($id)
    {
        $peliculaModel = new PeliculaModel();
        $titulo = $this->request->getPost('titulo');
        $descripcion = $this->request->getPost('descripcion');
         $peliculaModel->update($id, [
            'titulo' => $titulo,
            'descripcion' => $descripcion
         ]);
         return redirect()->to('/dashboard/pelicula');
    }
    public function delete($id)
    {
        $peliculaModel = new PeliculaModel();
        $peliculaModel->delete($id);
        return redirect()->back();
    }
}
