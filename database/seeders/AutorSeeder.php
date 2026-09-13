<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Autor;

class AutorSeeder extends Seeder
{
    public function run(): void
    {
        Autor::create(['nome' => 'Machado de Assis', 'nacionalidade' => 'Brasileira']);
        Autor::create(['nome' => 'Jose Saramago', 'nacionalidade' => 'Portuguesa']);
        Autor::create(['nome' => 'Clarice Lispector', 'nacionalidade' => 'Brasileira']);
    }
}