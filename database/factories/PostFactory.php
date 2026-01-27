<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;


class PostFactory extends Factory
{
    // Indica qué modelo va a usar este factory
    protected $model = Post::class;

    public function definition(): array
    {
        $titulo = $this->faker->sentence(6); //Crea un titulo aleatorio
        return [
            'titulo' => $titulo,
            'slug' => str()->slug($titulo), //Genera un slug unico
            'contenido' => $this->faker->text(1000), //Contenido largo
            'imagen_portada' => null,
            'publicado' => $this->faker->boolean(80),// 80% de probabilidad de ser TRUE
            // user_id lo pasaremos directamente en el Seeder
        ];
    }
}
