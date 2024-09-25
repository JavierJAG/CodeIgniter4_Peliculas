<?php

namespace App\Models;

use CodeIgniter\Model;

class PeliculaEtiquetaModel extends Model
{
    protected $table            = 'pelicula_etiqueta';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pelicula_id', 'etiqueta_id'];

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

    public function buscarEtiqueta($etiquetaId, $peliculaId)
    {
        return $this->where('etiqueta_id', $etiquetaId)->where('pelicula_id', $peliculaId)->first();
    }
    public function deleteEtiquetaById($id, $etiquetaId)
    {
        $this->where('etiqueta_id', $etiquetaId)
            ->where('pelicula_id', $id)->delete();
        echo '{"mensaje":"Eliminado"}';
    }
}
