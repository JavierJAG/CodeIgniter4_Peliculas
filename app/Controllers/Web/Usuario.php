<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Usuario extends BaseController
{
    public function index()
    {
        return view('web/index');
    }
    function new()
    {
        return view('/web/new');
    }
    function login()
    {
        $usuariosModel = new UsuariosModel();
        $usuario = $this->request->getPost('usuario');
        $usuarioDB = $usuariosModel->buscarUsuario($usuario);
        if ($usuarioDB != null) {
            $contrasena = $this->request->getPost('contrasena');
            if ($usuariosModel->contrasenaVerificar($contrasena, $usuarioDB->contrasena)) {
                unset($usuarioDB->contrasena);
                session()->set('usuario', $usuarioDB);
                return redirect()->to('/web/show');
            } else {
                return  redirect()->back()->with('mensaje', 'Usuario o contraseña incorrecto');
            }
        } else {
            return redirect()->back()->with('mensaje', 'Usuario o contraseña incorrecto');
        }
        return redirect()->to('/web/index')->with('mensaje', 'Usuario o contraseña incorrecto');
    }
    function show()
    {
        return view('/web/show');
    }
    function create()
    {
        if ($this->validate('usuarios')) {
            $usuariosModel = new UsuariosModel();
            $usuario = $this->request->getPost('usuario');
            $email = $this->request->getPost('email');
            $contrasena = $this->request->getPost('contrasena');
            $usuariosModel->crearUsuario($usuario, $email, $usuariosModel->contrasenaHash($contrasena));
            return redirect()->to('/web/index')->with('mensaje', 'Usuario con éxito');
        } else {
            return redirect()->to('/web/index')->with('mensaje', $this->validator->listErrors());
        }
    }
    function logout()
    {  
        session()->destroy();
        return redirect()->to('/web/index');
    }
}
