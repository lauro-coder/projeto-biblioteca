<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Livro;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLivros = Livro::count();
        $totalAutores = Autor::count();
        $totalUsuarios = User::count();

        $ultimosLivros = Livro::with('autor')->latest()->take(5)->get();

        return view('dashboard', compact('totalLivros', 'totalAutores', 'totalUsuarios', 'ultimosLivros'));
    }
}
