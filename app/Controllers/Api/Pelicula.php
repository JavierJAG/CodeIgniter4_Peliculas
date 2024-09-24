<?php 

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Pelicula extends ResourceController{
    protected $modelName = 'App\Models\PeliculaModel';
    protected $format = 'json'; //Podría ser xml


    public function index()
    {
        return $this->respond($this->model->findAll());
    }
    public function show($id=null){
        return $this->respond($this->model->find($id));
    }
    public function create(){
       
        if ($this->validate('peliculas')) {
            $this->model->insert([
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion')
            ]);
            return $this->respond('ok');
        } else {
            return $this->respond($this->validator->getErrors(),400);
        }
       
    }
    public function update($id=null){
        if ($this->validate('peliculas')) {
            $titulo = $this->request->getRawInput()['titulo'];
            $descripcion = $this->request->getRawInput()['descripcion'];
            $this->model->update($id, [
                'titulo' => $titulo,
                'descripcion' => $descripcion
            ]);
            return $this->respond('ok');
           
        } else {
            return $this->respond($this->validator->getErrors(),400);
        }

    }
    public function delete($id=null){
        $this->model->delete($id);
        return $this->respond('ok');
    }
}





