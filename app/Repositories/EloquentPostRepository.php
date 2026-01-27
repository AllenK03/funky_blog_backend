<?php

namespace App\Repositories;

use App\Models\Post;

class EloquentPostRepository implements PostRepositoryInterface
{
    public function all()
    {
        return Post::orderBy('created_at', 'desc')->get();
    }

    public function create(array $data)
    {
        return Post::create($data);
    }

    public function update(Post $post, array $data)
    {
        return $post->update($data);
    }

    public function delete(Post $post)
    {
        return $post->delete();
    }
}