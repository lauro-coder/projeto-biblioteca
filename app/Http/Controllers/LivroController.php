<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Models\Livro;
use App\Models\Autor;
use Illuminate\Support\Facades\Gate;

class LivroController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Livro::class);

        $livros = Livro::with('autor')->orderBy('titulo')->get();

        return view('livros.index', compact('livros'));
    }

    public function show(Livro $livro)
    {
        Gate::authorize('view', $livro);

        $livro->load('autor');

        return view('livros.show', compact('livro'));
    }

    public function create()
    {
        Gate::authorize('create', Livro::class);

        $autores = Autor::orderBy('nome')->get();

        return view('livros.create', compact('autores'));
    }

    public function store(LivroRequest $request)
    {
        Gate::authorize('create', Livro::class);

        Livro::create($request->validated());

        return redirect()->route('livros.index')->with('sucesso', 'Livro cadastrado com sucesso!');
    }

    public function edit(Livro $livro)
    {
        Gate::authorize('update', $livro);

        $autores = Autor::orderBy('nome')->get();

        return view('livros.edit', compact('livro', 'autores'));
    }

    public function update(LivroRequest $request, Livro $livro)
    {
        Gate::authorize('update', $livro);

        $livro->update($request->validated());

        return redirect()->route('livros.show', $livro)->with('sucesso', 'Livro atualizado com sucesso!');
    }

    public function destroy(Livro $livro)
    {
        Gate::authorize('delete', $livro);

        $livro->delete();

        return redirect()->route('livros.index')->with('sucesso', 'Livro excluído com sucesso!');
    }
}
