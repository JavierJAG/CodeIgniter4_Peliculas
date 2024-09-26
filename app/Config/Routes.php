<?php

use App\Controllers\Web\Usuario;
use CodeIgniter\Router\RouteCollection;

// $routes->setAutoRutes(false);    en true genera rutas de la forma nombreControlador/método
/**
 * @var RouteCollection $routes
 */
$routes->group('dashboard', ['namespace' => 'App\Controllers\Dashboard'], function ($routes) {
    $routes->post('pelicula/(:num)/imagen/(:num)/delete', 'Pelicula::borrar_imagen/$1/$2');
    $routes->get('pelicula/etiquetas/(:num)', 'Pelicula::etiquetas/$1');
    $routes->post('pelicula/imagen/descargar/(:num)', 'Pelicula::descargar_imagen/$1');
    $routes->post('pelicula/etiquetas/(:num)', 'Pelicula::etiquetas_post/$1');
    $routes->post('pelicula/(:num)/etiqueta/(:num)/delete','Pelicula::etiqueta_delete/$1/$2');
    $routes->presenter('pelicula');
    $routes->presenter('etiqueta');
    $routes->presenter('categoria', ['except' => ['show']]);
    // $routes->presenter('categoria',['except'=>['show'],'controller'=>'Dashboard\Categoria']);    Forma de hacerlo individualmente

});
$routes->group('web', ['namespace' => '\App\Controllers\Web'], function ($routes) {
    $routes->get('index', 'Usuario::index');
    $routes->get('new', 'Usuario::new');
    $routes->get('show', 'Usuario::show');
    $routes->post('login', 'Usuario::login');
    $routes->post('create', 'Usuario::create');
    $routes->post('logout', 'Usuario::logout');
});
$routes->group('api', ['namespace' => '\App\Controllers\Api'], function ($routes) {
    $routes->resource('pelicula'/* ,['except'=>['index']] */);
    $routes->resource('categoria');
});


/* +--------+---------------------------------+------+-------------------------------------------------+----------------+---------------+
| Method | Route                           | Name | Handler                                         | Before Filters | After Filters |
+--------+---------------------------------+------+-------------------------------------------------+----------------+---------------+
| GET    | dashboard/pelicula              | »    | \App\Controllers\Dashboard\Pelicula::index      | usuarios       |               |
| GET    | dashboard/pelicula/show/(.*)    | »    | \App\Controllers\Dashboard\Pelicula::show/$1    | usuarios       |               |
| GET    | dashboard/pelicula/new          | »    | \App\Controllers\Dashboard\Pelicula::new        | usuarios       |               |
| GET    | dashboard/pelicula/edit/(.*)    | »    | \App\Controllers\Dashboard\Pelicula::edit/$1    | usuarios       |               |
| GET    | dashboard/pelicula/remove/(.*)  | »    | \App\Controllers\Dashboard\Pelicula::remove/$1  | usuarios       |               |
| GET    | dashboard/pelicula/(.*)         | »    | \App\Controllers\Dashboard\Pelicula::show/$1    | usuarios       |               |
| GET    | dashboard/categoria             | »    | \App\Controllers\Dashboard\Categoria::index     | usuarios       |               |
| GET    | dashboard/categoria/new         | »    | \App\Controllers\Dashboard\Categoria::new       | usuarios       |               |
| GET    | dashboard/categoria/edit/(.*)   | »    | \App\Controllers\Dashboard\Categoria::edit/$1   | usuarios       |               |
| GET    | dashboard/categoria/remove/(.*) | »    | \App\Controllers\Dashboard\Categoria::remove/$1 | usuarios       |               |
| GET    | web/index                       | »    | \App\Controllers\Web\Usuario::index             |                |               |
| GET    | web/new                         | »    | \App\Controllers\Web\Usuario::new               |                |               |
| GET    | web/show                        | »    | \App\Controllers\Web\Usuario::show              |                |               |
| GET    | api/pelicula                    | »    | \App\Controllers\Api\Pelicula::index            |                |               |
| GET    | api/pelicula/new                | »    | \App\Controllers\Api\Pelicula::new              |                |               |
| GET    | api/pelicula/(.*)/edit          | »    | \App\Controllers\Api\Pelicula::edit/$1          |                |               |
| GET    | api/pelicula/(.*)               | »    | \App\Controllers\Api\Pelicula::show/$1          |                |               |
| POST   | dashboard/pelicula/create       | »    | \App\Controllers\Dashboard\Pelicula::create     | usuarios       |               |
| POST   | dashboard/pelicula/update/(.*)  | »    | \App\Controllers\Dashboard\Pelicula::update/$1  | usuarios       |               |
| POST   | dashboard/pelicula/delete/(.*)  | »    | \App\Controllers\Dashboard\Pelicula::delete/$1  | usuarios       |               |
| POST   | dashboard/pelicula              | »    | \App\Controllers\Dashboard\Pelicula::create     | usuarios       |               |
| POST   | dashboard/categoria/create      | »    | \App\Controllers\Dashboard\Categoria::create    | usuarios       |               |
| POST   | dashboard/categoria/update/(.*) | »    | \App\Controllers\Dashboard\Categoria::update/$1 | usuarios       |               |
| POST   | dashboard/categoria/delete/(.*) | »    | \App\Controllers\Dashboard\Categoria::delete/$1 | usuarios       |               |
| POST   | dashboard/categoria             | »    | \App\Controllers\Dashboard\Categoria::create    | usuarios       |               |
| POST   | web/login                       | »    | \App\Controllers\Web\Usuario::login             |                |               |
| POST   | web/create                      | »    | \App\Controllers\Web\Usuario::create            |                |               |
| POST   | web/logout                      | »    | \App\Controllers\Web\Usuario::logout            |                |               |
| POST   | api/pelicula                    | »    | \App\Controllers\Api\Pelicula::create           |                |               |
| PATCH  | api/pelicula/(.*)               | »    | \App\Controllers\Api\Pelicula::update/$1        |                |               |
| PUT    | api/pelicula/(.*)               | »    | \App\Controllers\Api\Pelicula::update/$1        |                |               |
| DELETE | api/pelicula/(.*)               | »    | \App\Controllers\Api\Pelicula::delete/$1        |                |               |
+--------+---------------------------------+------+-------------------------------------------------+----------------+---------------+ */