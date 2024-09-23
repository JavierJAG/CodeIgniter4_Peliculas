<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\PeliculaModel;
use PHPUnit\TextUI\XmlConfiguration\Validator;

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

        return view('/dashboard/peliculas/show', ['pelicula' => $peliculaModel->find($id)]);
    }
    public function new()
    {
        return view('/dashboard/peliculas/new');
    }
    public function edit($id)
    {
        $peliculaModel = new PeliculaModel();

        return view('/dashboard/peliculas/edit', ['pelicula' => $peliculaModel->find($id)]);
    }
    public function create()
    {
        $peliculaModel = new PeliculaModel();
        if ($this->validate('peliculas')) {
            $titulo = $this->request->getPost('titulo');
            $descripcion = $this->request->getPost('descripcion');
            $peliculaModel->insert([
                'titulo' => $titulo,
                'descripcion' => $descripcion
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
            $peliculaModel->update($id, [
                'titulo' => $titulo,
                'descripcion' => $descripcion
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
}
