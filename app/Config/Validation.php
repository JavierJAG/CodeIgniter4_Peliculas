<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $peliculas = [
        'titulo' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
        'descripcion' => 'required|alpha_numeric_space|min_length[3]',
        'categoria_id' => 'required'
    ];

    public $etiquetas = [
        'titulo' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
        'categoria_id' => 'required'
    ];


    public $categorias = [
        'titulo' => 'required|alpha_numeric_space|min_length[3]|max_length[30]'
    ];

    public $usuarios = [
        'usuario' => 'required|alpha_numeric|min_length[5]|is_unique[usuarios.usuario]',
        'email' => 'required|is_unique[usuarios.email]',
        'contrasena' => 'required|alpha_numeric|min_length[5]'
    ];
}
