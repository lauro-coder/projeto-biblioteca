<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\AutorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
    Route::get('/autores', [AutorController::class, 'index'])->name('autores.index');

    Route::middleware('role:admin,bibliotecario')->group(function () {
        Route::get('/livros/criar', [LivroController::class, 'create'])->name('livros.create');
        Route::post('/livros', [LivroController::class, 'store'])->name('livros.store');
        Route::get('/livros/{livro}/editar', [LivroController::class, 'edit'])->name('livros.edit');
        Route::put('/livros/{livro}', [LivroController::class, 'update'])->name('livros.update');

        Route::get('/autores/criar', [AutorController::class, 'create'])->name('autores.create');
        Route::post('/autores', [AutorController::class, 'store'])->name('autores.store');
        Route::get('/autores/{autor}/editar', [AutorController::class, 'edit'])->name('autores.edit');
        Route::put('/autores/{autor}', [AutorController::class, 'update'])->name('autores.update');
    });

    // exclusao controlada pelas policies (somente admin)
    Route::delete('/livros/{livro}', [LivroController::class, 'destroy'])->name('livros.destroy');
    Route::delete('/autores/{autor}', [AutorController::class, 'destroy'])->name('autores.destroy');

    Route::get('/livros/{livro}', [LivroController::class, 'show'])->name('livros.show');
    Route::get('/autores/{autor}', [AutorController::class, 'show'])->name('autores.show');
});

require __DIR__.'/auth.php';
