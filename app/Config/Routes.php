<?php

use CodeIgniter\Router\RouteCollection;

// $routes->setAutoRutes(TRUE);
/**
 * @var RouteCollection $routes
 */
$routes->group('dashboard', function($routes){
$routes->presenter('pelicula',['controller'=>'Dashboard\Pelicula']);
$routes->presenter('categoria',['except'=>['show'],'controller'=>'Dashboard\Categoria']);
});


/* +--------+-----------------------+------+---------------------------------------+----------------+---------------+
| Method | Route                 | Name | Handler                               | Before Filters | After Filters |
+--------+-----------------------+------+---------------------------------------+----------------+---------------+
| GET    | pelicula              | »    | \App\Controllers\Pelicula::index      |                |               |
| GET    | pelicula/show/(.*)    | »    | \App\Controllers\Pelicula::show/$1    |                |               |
| GET    | pelicula/new          | »    | \App\Controllers\Pelicula::new        |                |               |
| GET    | pelicula/edit/(.*)    | »    | \App\Controllers\Pelicula::edit/$1    |                |               |
| GET    | pelicula/remove/(.*)  | »    | \App\Controllers\Pelicula::remove/$1  |                |               |
| GET    | pelicula/(.*)         | »    | \App\Controllers\Pelicula::show/$1    |                |               |
| GET    | categoria             | »    | \App\Controllers\Categoria::index     |                |               |
| GET    | categoria/show/(.*)   | »    | \App\Controllers\Categoria::show/$1   |                |               |
| GET    | categoria/new         | »    | \App\Controllers\Categoria::new       |                |               |
| GET    | categoria/edit/(.*)   | »    | \App\Controllers\Categoria::edit/$1   |                |               |
| GET    | categoria/remove/(.*) | »    | \App\Controllers\Categoria::remove/$1 |                |               |
| GET    | categoria/(.*)        | »    | \App\Controllers\Categoria::show/$1   |                |               |
| POST   | pelicula/create       | »    | \App\Controllers\Pelicula::create     |                |               |
| POST   | pelicula/update/(.*)  | »    | \App\Controllers\Pelicula::update/$1  |                |               |
| POST   | pelicula/delete/(.*)  | »    | \App\Controllers\Pelicula::delete/$1  |                |               |
| POST   | pelicula              | »    | \App\Controllers\Pelicula::create     |                |               |
| POST   | categoria/create      | »    | \App\Controllers\Categoria::create    |                |               |
| POST   | categoria/update/(.*) | »    | \App\Controllers\Categoria::update/$1 |                |               |
| POST   | categoria/delete/(.*) | »    | \App\Controllers\Categoria::delete/$1 |                |               |
| POST   | categoria             | »    | \App\Controllers\Categoria::create    |                |               |
+--------+-----------------------+------+---------------------------------------+----------------+---------------+ */