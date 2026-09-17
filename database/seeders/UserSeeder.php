<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'password' => '12345678',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Bibliotecario',
            'email' => 'bibliotecario@email.com',
            'password' => '12345678',
            'role' => 'bibliotecario',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Usuario',
            'email' => 'usuario@email.com',
            'password' => '12345678',
            'role' => 'usuario',
            'email_verified_at' => now(),
        ]);
    }
}
