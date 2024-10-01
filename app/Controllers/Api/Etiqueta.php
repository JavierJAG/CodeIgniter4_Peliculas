<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Etiqueta extends ResourceController {
    protected $modelName = 'App\Models\EtiquetaModel';
    protected $format = 'json';

    public function index(){
        return $this->respond($this->model->findAll());
    }
    public function show($id=null){
        return $this->respond($this->model->find($id));
    }
    public function create(){
       
        if ($this->validate('etiquetas')) {
            $this->model->insert([
                'titulo' => $this->request->getPost('titulo'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ]);
            return $this->respond('ok');
        } else {
            return $this->respond($this->validator->getErrors(),400);
        }
       
    }
    public function update($id=null){
        if ($this->validate('etiquetas')) {
            $titulo = $this->request->getRawInput()['titulo'];
            $categoriaId = $this->request->getRawInput()['categoria_id'];
            $this->model->update($id, [
                'titulo' => $titulo,
                'categoria_id'=>$categoriaId
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