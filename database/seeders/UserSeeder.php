<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Luis Usuario',
            'email' => 'luis@test.com',
            'password' => Hash::make('password'),
            'role' => 'usuario',
        ]);

        User::create([
            'name' => 'Ana Lectura',
            'email' => 'ana@test.com',
            'password' => Hash::make('password'),
            'role' => 'usuario',
        ]);

        User::create([
            'name' => 'Carlos Manga',
            'email' => 'carlos@test.com',
            'password' => Hash::make('password'),
            'role' => 'usuario',
        ]);

        User::create([
            'name' => 'María Comics',
            'email' => 'maria@test.com',
            'password' => Hash::make('password'),
            'role' => 'usuario',
        ]);

        User::create([
            'name' => 'Diego Biblioteca',
            'email' => 'diego@test.com',
            'password' => Hash::make('password'),
            'role' => 'usuario',
        ]);

        User::create([
            'name' => 'Sofía Novelas',
            'email' => 'sofia@test.com',
            'password' => Hash::make('password'),
            'role' => 'usuario',
        ]);

        User::create([
            'name' => 'Mateo Historias',
            'email' => 'mateo@test.com',
            'password' => Hash::make('password'),
            'role' => 'usuario',
        ]);

        User::create([
            'name' => 'Valeria Libros',
            'email' => 'valeria@test.com',
            'password' => Hash::make('password'),
            'role' => 'usuario',
        ]);

        User::create([
            'name' => 'Jorge Lector',
            'email' => 'jorge@test.com',
            'password' => Hash::make('password'),
            'role' => 'usuario',
        ]);
    }
}