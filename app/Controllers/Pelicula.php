<?php

namespace App\Controllers;

use App\Models\PeliculaModel;

class Pelicula extends BaseController
{

    public function index()
    {
        $peliculaModel = new PeliculaModel();

        return view("/peliculas/index", ['pelicula' => $peliculaModel->findAll()]);
    }
    public function show($id)
    {
        $peliculaModel = new PeliculaModel();

        return view('/peliculas/show',['pelicula'=>$peliculaModel->find($id)]);
    }
    public function new()
    {
       
        return view('/peliculas/new');
    }
    public function edit($id)
    {
        $peliculaModel = new PeliculaModel();

        return view('/peliculas/edit',['pelicula'=> $peliculaModel->find($id)]);
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
        echo "Pelicula añadida con éxito";

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

    }
    public function delete($id)
    {
        $peliculaModel = new PeliculaModel();
        $peliculaModel->delete($id);
        return view("/peliculas/index", ['pelicula' => $peliculaModel->findAll()]);
    }
}
