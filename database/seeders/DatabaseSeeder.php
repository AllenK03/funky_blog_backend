<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Importar el Modelo User
use App\Models\Post; // Importar el Modelo Post

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear el primer usuario (Necesario para la clave foránea user_id)
        User::factory()->create([
            'name' => 'Diego Administrador',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // Contraseña simple para pruebas
        ]);

        // 2. Crear 5 posts, asignándolos al usuario con ID 1 (el que acabamos de crear)
        Post::factory(5)->create([
            'user_id' => 1
        ]);
    }
}
