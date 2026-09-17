<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Livro;
use App\Models\Autor;

class LivroSeeder extends Seeder
{
    public function run(): void
    {
        $machado = Autor::where('nome', 'Machado de Assis')->first();
        $saramago = Autor::where('nome', 'Jose Saramago')->first();
        $clarice = Autor::where('nome', 'Clarice Lispector')->first();
        $orwell = Autor::where('nome', 'George Orwell')->first();

        Livro::create(['titulo' => 'Dom Casmurro', 'ano' => 1899, 'autor_id' => $machado->id]);
        Livro::create(['titulo' => 'Memorias Postumas de Bras Cubas', 'ano' => 1881, 'autor_id' => $machado->id]);
        Livro::create(['titulo' => 'Ensaio sobre a Cegueira', 'ano' => 1995, 'autor_id' => $saramago->id]);
        Livro::create(['titulo' => 'A Hora da Estrela', 'ano' => 1977, 'autor_id' => $clarice->id]);
        Livro::create(['titulo' => '1984', 'ano' => 1949, 'autor_id' => $orwell->id]);
    }
}
