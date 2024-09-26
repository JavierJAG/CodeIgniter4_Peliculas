<?php

namespace App\Models;

use CodeIgniter\Model;

class PeliculaModel extends Model
{
    protected $table            = 'peliculas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['titulo', 'descripcion', 'categoria_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];



    public function getPeliculaIndex()
    {
        return $this->select('peliculas.*,categorias.titulo as categoria')->join('categorias', 'categorias.id=peliculas.categoria_id')->find();
    }
    public function getImagesById($id)
    {
        return $this->select('imagenes.*')
            ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id=peliculas.id')  
            ->join('imagenes', 'pelicula_imagen.imagen_id=imagenes.id')             
            ->where('peliculas.id', $id)
            ->find();
    }

    public function getEtiquetasById($id)
    {
        return $this->select('e.*')
            ->join('pelicula_etiqueta as pe', 'pe.pelicula_id = peliculas.id')
            ->join('etiquetas as e', 'e.id = pe.etiqueta_id')
            ->where('peliculas.id', $id)
            ->find();
    }
}
