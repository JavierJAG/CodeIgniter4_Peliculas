<?php

namespace App\Models;

use App\Controllers\Web\Usuario;
use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['usuario', 'email', 'contrasena'];

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



    public function contrasenaHash(String $contrasena)
    {
        return password_hash($contrasena, PASSWORD_DEFAULT);
    }

    public function contrasenaVerificar($contrasena, $contrasenaHash)
    {
        return password_verify($contrasena, $contrasenaHash);
    }
    public function crearUsuario($usuario, $email, $contrasena)
    {
        $this->insert([
            'usuario' => $usuario,
            'email' => $email,
            'contrasena' => $contrasena
        ]);
    }
    public function buscarUsuario($usuario)
    {

        $usuarioEncontrado = $this->select('usuario,email,contrasena,tipo')->orWhere('usuario', $usuario)->orWhere('email', $usuario)->first();
        return $usuarioEncontrado;
    }
}
