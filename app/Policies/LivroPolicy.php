<?php

namespace App\Policies;

use App\Models\Livro;
use App\Models\User;

class LivroPolicy
{
    // qualquer usuario logado pode ver a lista e os detalhes
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Livro $livro): bool
    {
        return true;
    }

    // admin e bibliotecario podem cadastrar e editar
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isBibliotecario();
    }

    public function update(User $user, Livro $livro): bool
    {
        return $user->isAdmin() || $user->isBibliotecario();
    }

    // somente o admin pode excluir
    public function delete(User $user, Livro $livro): bool
    {
        return $user->isAdmin();
    }
}
