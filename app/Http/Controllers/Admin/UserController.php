<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('name')->get();

        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function edit(User $usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(UpdateUserRoleRequest $request, User $usuario)
    {
        // o admin nao pode tirar o proprio acesso
        if ($usuario->is($request->user())) {
            return redirect()->route('admin.usuarios.index')
                ->with('erro', 'Você não pode alterar o seu próprio nível de acesso.');
        }

        $usuario->update(['role' => $request->validated('role')]);

        return redirect()->route('admin.usuarios.index')->with('sucesso', 'Nível de acesso atualizado com sucesso!');
    }

    public function destroy(Request $request, User $usuario)
    {
        if ($usuario->is($request->user())) {
            return redirect()->route('admin.usuarios.index')
                ->with('erro', 'Você não pode excluir a sua própria conta por aqui.');
        }

        $usuario->delete();

        return redirect()->route('admin.usuarios.index')->with('sucesso', 'Usuário excluído com sucesso!');
    }
}
