<?php

namespace App\Repositories;

use App\Models\Post;

interface PostRepositoryInterface
{
    // Este contrato dice que cualquier repositorio de Posts DEBE tener estos métodos:
    public function all();
    public function create(array $data);
    public function update(Post $post, array $data);
    public function delete(Post $post);
}