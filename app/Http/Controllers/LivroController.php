<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Autor;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $livros = Livro::with('autor')->get();

    return view('livros.index', compact('livros'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $autores = Autor::all();

    return view('livros.create', compact('autores'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $dados = $request->validate([
        'titulo' => 'required|min:3',
        'ano' => 'nullable|integer',
        'autor_id' => 'required|exists:autores,id',
    ]);

    Livro::create($dados);

    return redirect()->route('livros.index')->with('sucesso', 'Livro cadastrado com sucesso');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $livro = Livro::findOrFail($id);
    $autores = Autor::all();

    return view('livros.edit', compact('livro', 'autores'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $livro = Livro::findOrFail($id);

    $dados = $request->validate([
        'titulo' => 'required|min:3',
        'ano' => 'nullable|integer',
        'autor_id' => 'required|exists:autores,id',
    ]);

    $livro->update($dados);

    return redirect()->route('livros.index')->with('sucesso', 'Livro atualizado com sucesso!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $livro = Livro::findOrFail($id);
    $livro->delete();

    return redirect()->route('livros.index')->with('sucesso', 'Livro excluído com sucesso!');
}
}
