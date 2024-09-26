<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{

    public function index()
    {
        $peliculaModel = new PeliculaModel();
        $data = $peliculaModel->getPeliculaIndex();
        return view('/dashboard/peliculas/index', ['pelicula' => $data,'pager' => $peliculaModel->pager]);
    }
    public function show($id)
    {
        $peliculaModel = new PeliculaModel();

        return view('/dashboard/peliculas/show', [
            'pelicula' => $peliculaModel->find($id),
            'etiquetas' => $peliculaModel->getEtiquetasById($id),
            'imagenes' => $peliculaModel->getImagesById($id)
        ]);
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
            $this->asignar_imagen($id);
            // session()->setFlashdata('mensaje', 'Película actualizada correctamente'); // Datos disponibles solo durante la siguiente solicitud, set() es permanente hasta que se cierre la sesion
            // return redirect()->to('/dashboard/pelicula');
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
        if (!$peliculaEtiqueta) {
            $peliculaEtiquetaModel->insert([
                'pelicula_id' => $peliculaId,
                'etiqueta_id' => $etiquetaId
            ]);
        }
        return redirect()->back();
    }
    function etiqueta_delete($id, $etiquetaId)
    {
        $peliculaEtiqueta = new PeliculaEtiquetaModel();
        $peliculaEtiqueta->deleteEtiquetaById($id, $etiquetaId);
        return redirect()->back()->with('mensaje', 'Etiqueta eliminada');
    }

    private function asignar_imagen($peliculaId)
    {
        helper('filesystem');
        $imagefile = $this->request->getFile('imagen');

        // Verifica si el archivo es válido
        if ($imagefile && $imagefile->isValid()) {
            // Imprime información del archivo para depuración
            echo "MIME type: " . $imagefile->getClientMimeType();
            echo "File name: " . $imagefile->getName();

            // Realiza la validación
            $validated = $this->validate([
                'imagen' => [
                    'uploaded[imagen]',
                    'mime_in[imagen,image/jpg,image/gif,image/png,image/jpeg]',
                    'max_size[imagen,4096]'
                ]
            ]);


            if ($validated) {
                // Generar un nombre de archivo aleatorio
                $imageNombre = $imagefile->getRandomName();

                // Verifica la ruta y si es válida
                $ruta = '../public/uploads/peliculas';
                if (!is_string($ruta)) {
                    echo "Error: La ruta no es una cadena válida.";
                }
                if (!is_string($imageNombre)) {
                    echo "Error: El nombre del archivo no es una cadena válida.";
                }
                $ext = $imagefile->guessExtension();
                // Intenta mover el archivo a la ruta especificada
                if ($imagefile->move($ruta, $imageNombre)) {
                    echo "Imagen subida correctamente.";
                } else {
                    echo "Error al mover el archivo.";
                }

                $imagenModel = new ImagenModel();

                $imagenId = $imagenModel->insert([
                    'imagen' => $imageNombre,
                    'extension' => $ext,
                    'data' => json_encode(get_file_info('../public/uploads/peliculas/'.$imageNombre))
                ]);

                $peliculaImagenModel = new PeliculaImagenModel();
                $peliculaImagenModel->insert([
                    'imagen_id' => $imagenId,
                    'pelicula_id' => $peliculaId
                ]);
            } else {
                echo $this->validator->listErrors();
            }
        } else {
            echo $this->validator->listErrors();
        }
    }

    public function borrar_imagen($peliculaId, $imagenId)
    {
        $imagenModel = new ImagenModel();
        $peliculaImagenModel = new PeliculaImagenModel();

        $imagen = $imagenModel->find($imagenId);
        if ($imagen == null) {
            return 'no existe';
        }
        $rutaImagen = 'uploads/peliculas/' . $imagen->imagen;
        unlink($rutaImagen);

        $peliculaImagenModel->where('imagen_id', $imagenId)->where('pelicula_id', $peliculaId)->delete();
        // $imagenModel->delete(); No interesa borrar la imágen por si se utiliza en otro lado
        return redirect()->back()->with('mensaje', 'Imagen eliminada');
    }

    public function descargar_imagen($imagenId){
        $imagenModel = new ImagenModel();
        $imagen = $imagenModel->find($imagenId);
        if ($imagen == null) {
            return 'no existe';
        }
        $rutaImagen = 'uploads/peliculas/' . $imagen->imagen;
        return $this->response->download($rutaImagen,null)/* ->setFileName('nombre.jpg') opcion para dejar otro nombre */;
    }
    
}
