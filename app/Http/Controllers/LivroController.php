<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Models\Livro;
use App\Models\Autor;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::with('autor')->orderBy('titulo')->get();

        return view('livros.index', compact('livros'));
    }

    public function create()
    {
        $autores = Autor::orderBy('nome')->get();

        return view('livros.create', compact('autores'));
    }

    public function store(LivroRequest $request)
    {
        Livro::create($request->validated());

        return redirect()->route('livros.index')->with('sucesso', 'Livro cadastrado com sucesso!');
    }

    public function edit(string $id)
    {
        $livro = Livro::findOrFail($id);
        $autores = Autor::orderBy('nome')->get();

        return view('livros.edit', compact('livro', 'autores'));
    }

    public function update(LivroRequest $request, string $id)
    {
        $livro = Livro::findOrFail($id);

        $livro->update($request->validated());

        return redirect()->route('livros.index')->with('sucesso', 'Livro atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $livro = Livro::findOrFail($id);
        $livro->delete();

        return redirect()->route('livros.index')->with('sucesso', 'Livro excluído com sucesso!');
    }
}
