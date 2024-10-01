<?php 

namespace App\Controllers\Api;

use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
use CodeIgniter\RESTful\ResourceController;

class Pelicula extends ResourceController{
    protected $modelName = 'App\Models\PeliculaModel';
    protected $format = 'json'; //Podría ser xml


    public function index()
    {
        return $this->respond($this->model->findAll());
    }
    public function show($id=null){
        $pelicula = $this->model
            ->select('peliculas.*, categorias.titulo as categoria')
            ->join('categorias', 'categorias.id = peliculas.categoria_id')
            ->where('peliculas.id', $id)
            ->first();

        // Obtener imágenes y etiquetas con métodos personalizados
        $data = [
            'pelicula' => $pelicula,
            'imagenes' => $this->model->getImagesById($id),  // Método personalizado para obtener imágenes
            'etiquetas' => $this->model->getEtiquetasById($id) // Método personalizado para obtener etiquetas
        ];
        return $this->respond($data);
    }
    public function create(){
       
        if ($this->validate('peliculas')) {
            $this->model->insert([
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria_id' =>$this->request->getPost('categoria_id')
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
            $categoriaId = $this->request->getRawInput()['categoria_id'];
            $this->model->update($id, [
                'titulo' => $titulo,
                'descripcion' => $descripcion,
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

    public function paginado(){
        return $this->respond($this->model->paginate(10));
    }
    public function paginado_full(){
        $peliculas = $this->model->select('peliculas.*, categorias.titulo as categoria, MAX(imagenes.imagen) as imagen')
        ->join('categorias', 'categorias.id = peliculas.categoria_id')
        ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', 'left')
        ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id', 'left')
        ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id = peliculas.id', 'left')
        ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_id', 'left');

    // Filtro de búsqueda
    if ($buscar = $this->request->getGet('buscar')) {
        $peliculas->groupStart()
            ->orLike('peliculas.titulo', $buscar, 'both')
            ->orLike('peliculas.descripcion', $buscar, 'both')
            ->groupEnd();
    }

    // Filtro por categoría
    if ($categoriaId = $this->request->getGet('categoria_id')) {
        $peliculas->where('peliculas.categoria_id', $categoriaId);
    }

    // Filtro por etiqueta
    if ($etiquetaId = $this->request->getGet('etiqueta_id')) {
        $peliculas->where('etiquetas.id', $etiquetaId);
    }

    // Agrupación y paginación
    $peliculas = $peliculas->groupBy('peliculas.id');
    return $this->respond($peliculas->paginate(10));
    }

    function index_por_categoria($categoriaId) {
        $peliculas = $this->model->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(etiquetas.titulo SEPARATOR ",") as etiquetas, MAX(imagenes.imagen) as imagen')
        ->join('categorias', 'categorias.id = peliculas.categoria_id')
        ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', 'left')
        ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id', 'left')
        ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id = peliculas.id', 'left')
        ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_id', 'left')
        ->where('peliculas.categoria_id', $categoriaId)
        ->groupBy('peliculas.id')
        ->paginate(10);

        return $this->respond($peliculas);
    }
    function index_por_etiqueta($etiquetaId){
        $peliculas = $this->model->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(etiquetas.titulo SEPARATOR ",") as etiquetas, GROUP_CONCAT(etiquetas.id SEPARATOR ",") as etiqueta_ids, MAX(imagenes.imagen) as imagen')
            ->join('categorias', 'categorias.id = peliculas.categoria_id')
            ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', 'left')
            ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id', 'left')
            ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id = peliculas.id', 'left')
            ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_id', 'left')
            ->where('pelicula_etiqueta.etiqueta_id', $etiquetaId) // Filtrar por etiqueta
            ->groupBy('peliculas.id')
            ->paginate(10);
            return $this->respond($peliculas);
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
        return $this->respond('ok');
    }
    function etiqueta_delete($id, $etiquetaId)
    {
        $peliculaEtiqueta = new PeliculaEtiquetaModel();
        $peliculaEtiqueta->deleteEtiquetaById($id, $etiquetaId);
        return $this->respond('ok');
    }
    public function upload_imagen($peliculaId)
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
                return $this->respond('La imagen es cargada con éxito');
            } else {
                return $this->respond('Error en la imagen',400);
            }
        } else {
            return $this->respond('La imagen es requerida',400);
        }
    }
    public function borrar_imagen($peliculaId, $imagenId)
    {
        $imagenModel = new ImagenModel();
        $peliculaImagenModel = new PeliculaImagenModel();

        $imagen = $imagenModel->find($imagenId);
        if ($imagen == null) {
            return $this->respond('error');
        }
        $rutaImagen = 'uploads/peliculas/' . $imagen->imagen;
        unlink($rutaImagen);

        $peliculaImagenModel->where('imagen_id', $imagenId)->where('pelicula_id', $peliculaId)->delete();
        // $imagenModel->delete(); No interesa borrar la imágen por si se utiliza en otro lado
        return $this->respond('ok');
    }

    
}





