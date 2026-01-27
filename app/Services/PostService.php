<?php

namespace App\Services;

use App\Repositories\PostRepositoryInterface;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostService
{
    protected $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllPosts()
    {
        return $this->repository->all();
    }

    public function createPost(array $data)
    {
        try{
            $data['user_id'] = 1;
            $data['slug'] = Str::slug($data['titulo']); // Generamos el slug automáticamente a partir del título
            $data['publicado'] = (isset($data['publicado']) && $data['publicado'] == 1) ? 1 : 0;

            return $this->repository->create($data);
        }catch (Exception $e) {
            Log::error("Error al crear post: " . $e->getMessage()); // Guardamos el error real en storage/logs/laravel.log para el programador
            throw new Exception("No se pudo crear la publicacion. Intentalo de nuevo. ");
        }
    }

    public function updatePost(Post $post, array $data)
    {
        try {
            // Si nos envían un título, generamos el slug nuevo
            if (isset($data['titulo'])){
                $data['slug'] = Str::slug($data['titulo']);
            }
            return $this->repository->update($post, $data);

        } catch (Exception $e) {
            Log::error("Error al actualizar post: " . $e->getMessage());
            throw new Exception("Hubo un problema al actulizar la publicacion.");
        }
    }

    public function deletePost(Post $post)
    {
        try{
            return $this->repository->delete($post);
        } catch (Exception $e) {
            Log::error("Error al eliminar post ID {$post->id}: " . $e->getMessage());
            throw new Exception("No se pudo eliminar la publicacion.");
        }
    }
}