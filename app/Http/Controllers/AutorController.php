<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorRequest;
use App\Models\Autor;
use Illuminate\Support\Facades\Gate;

class AutorController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Autor::class);

        $autores = Autor::withCount('livros')->orderBy('nome')->get();

        return view('autores.index', compact('autores'));
    }

    public function show(Autor $autor)
    {
        Gate::authorize('view', $autor);

        $livros = $autor->livros()->orderBy('ano')->get();

        return view('autores.show', compact('autor', 'livros'));
    }

    public function create()
    {
        Gate::authorize('create', Autor::class);

        return view('autores.create');
    }

    public function store(AutorRequest $request)
    {
        Gate::authorize('create', Autor::class);

        $autor = Autor::create($request->validated());

        return redirect()->route('autores.show', $autor)->with('sucesso', 'Autor cadastrado com sucesso!');
    }

    public function edit(Autor $autor)
    {
        Gate::authorize('update', $autor);

        return view('autores.edit', compact('autor'));
    }

    public function update(AutorRequest $request, Autor $autor)
    {
        Gate::authorize('update', $autor);

        $autor->update($request->validated());

        return redirect()->route('autores.show', $autor)->with('sucesso', 'Autor atualizado com sucesso!');
    }

    public function destroy(Autor $autor)
    {
        Gate::authorize('delete', $autor);

        // nao deixa apagar autor que ainda tem livros (a FK apagaria os livros em cascata)
        if ($autor->livros()->exists()) {
            return redirect()->route('autores.show', $autor)
                ->with('erro', 'Não é possível excluir um autor que possui livros cadastrados.');
        }

        $autor->delete();

        return redirect()->route('autores.index')->with('sucesso', 'Autor excluído com sucesso!');
    }
}
