<?php

namespace App\Policies;

use App\Models\Autor;
use App\Models\User;

class AutorPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Autor $autor): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isBibliotecario();
    }

    public function update(User $user, Autor $autor): bool
    {
        return $user->isAdmin() || $user->isBibliotecario();
    }

    public function delete(User $user, Autor $autor): bool
    {
        return $user->isAdmin();
    }
}
