<?php

namespace App\Controllers\Blog;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{

    public function index()
    {
        // Inicialización de modelos
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();

        // Consulta de películas con joins a las tablas relacionadas
        $peliculas = $peliculaModel->select('peliculas.*, categorias.titulo as categoria, MAX(imagenes.imagen) as imagen')
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
        $peliculas = $peliculas->groupBy('peliculas.id')->paginate(10);

        // Datos para pasar a la vista
        $data = [
            'pelicula' => $peliculas,
            'categorias' => $categoriaModel->findAll(),
            'etiquetas' => $etiquetaModel->getEtiquetaIndex(),
            'pager' => $peliculaModel->pager,
            'categoria_id' => $this->request->getGet('categoria_id'),
            'etiqueta_id' => $this->request->getGet('etiqueta_id'),
            'buscar' => $this->request->getGet('buscar')
        ];

        // Renderizado de la vista
        return view('/blog/pelicula/index', $data);
    }


    public function show($id)
    {
        $peliculaModel = new PeliculaModel();

        // Obtener la película sin concatenar las etiquetas
        $pelicula = $peliculaModel
            ->select('peliculas.*, categorias.titulo as categoria')
            ->join('categorias', 'categorias.id = peliculas.categoria_id')
            ->where('peliculas.id', $id)
            ->first();

        // Obtener imágenes y etiquetas con métodos personalizados
        $data = [
            'pelicula' => $pelicula,
            'imagenes' => $peliculaModel->getImagesById($id),  // Método personalizado para obtener imágenes
            'etiquetas' => $peliculaModel->getEtiquetasById($id) // Método personalizado para obtener etiquetas
        ];

        return view('/blog/pelicula/show', $data);
    }

    //-------JSON----------

    public function etiquetas_por_categoria($categoriaId)
    {
        $etiquetaModel = new EtiquetaModel();
        $etiquetas = $etiquetaModel->where('categoria_id', $categoriaId)->find();

        // Devolver solo el JSON
        // Al usar json_encode() metia información adicional al hacer fetch y no funciona
        return $this->response->setJSON($etiquetas); // Asegúrate de que no haya salida adicional
    }

    public function index_por_categoria($categoriaId)
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();

        // Selección de las películas con sus categorías, etiquetas e imágenes
        $peliculas = $peliculaModel->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(etiquetas.titulo SEPARATOR ",") as etiquetas, MAX(imagenes.imagen) as imagen')
            ->join('categorias', 'categorias.id = peliculas.categoria_id')
            ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', 'left')
            ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id', 'left')
            ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id = peliculas.id', 'left')
            ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_id', 'left')
            ->where('peliculas.categoria_id', $categoriaId)
            ->groupBy('peliculas.id')
            ->paginate(10);

        // Datos para pasar a la vista
        $data = [
            'pelicula' => $peliculas,
            'pager' => $peliculaModel->pager,
            'categoria' => $categoriaModel->find($categoriaId) // Puedes enviar el detalle de la categoría actual
        ];

        // Renderizado de la vista
        return view('/blog/pelicula/index_por_categoria', $data);
    }

    public function index_por_etiqueta($etiquetaId)
    {
        $peliculaModel = new PeliculaModel();
        $etiquetaModel = new EtiquetaModel();
    
        // Selección de las películas con sus categorías, etiquetas e imágenes
        $peliculas = $peliculaModel->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(etiquetas.titulo SEPARATOR ",") as etiquetas, GROUP_CONCAT(etiquetas.id SEPARATOR ",") as etiqueta_ids, MAX(imagenes.imagen) as imagen')
            ->join('categorias', 'categorias.id = peliculas.categoria_id')
            ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', 'left')
            ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id', 'left')
            ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id = peliculas.id', 'left')
            ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_id', 'left')
            ->where('pelicula_etiqueta.etiqueta_id', $etiquetaId) // Filtrar por etiqueta
            ->groupBy('peliculas.id')
            ->paginate(10);
    
        // Datos para pasar a la vista
        $data = [
            'pelicula' => $peliculas,
            'pager' => $peliculaModel->pager,
            'etiqueta' => $etiquetaModel->find($etiquetaId) // Enviar el detalle de la etiqueta actual
        ];
    
        // Renderizado de la vista
        return view('/blog/pelicula/index_por_etiqueta', $data);
    }
    
    
}
