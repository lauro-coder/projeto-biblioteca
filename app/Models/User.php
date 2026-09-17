<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // niveis de acesso do sistema
    public const ROLES = [
        'admin' => 'Administrador',
        'bibliotecario' => 'Bibliotecário',
        'usuario' => 'Usuário',
    ];

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isBibliotecario(): bool
    {
        return $this->role === 'bibliotecario';
    }

    public function nomeRole(): string
    {
        return self::ROLES[$this->role] ?? $this->role;
    }
}
