<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Categoria extends ResourceController {
    protected $modelName = 'App\Models\CategoriaModel';
    protected $format = 'json';

    public function index(){
        return $this->respond($this->model->findAll());
    }
    public function show($id=null){
        return $this->respond($this->model->find($id));
    }
    public function create(){
       
        if ($this->validate('categorias')) {
            $this->model->insert([
                'titulo' => $this->request->getPost('titulo')
            ]);
            return $this->respond('ok');
        } else {
            return $this->respond($this->validator->getErrors(),400);
        }
       
    }
    public function update($id=null){
        if ($this->validate('categorias')) {
            $titulo = $this->request->getRawInput()['titulo'];
            $this->model->update($id, [
                'titulo' => $titulo
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
