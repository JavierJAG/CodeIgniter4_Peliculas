<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TodoSeeder extends Seeder
{
    public function run()
    {
       $this->call('CategoriaSeeder');
       $this->call('PeliculaSeeder');
    }
}
