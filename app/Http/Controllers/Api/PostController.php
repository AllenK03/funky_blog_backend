<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(): JsonResponse
    {
        $posts = $this->postService->getAllPosts();
        return response()->json(['data' => $posts], 200);
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json(['data' => $post], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
        ]);

        $post = $this->postService->createPost($validated);

        return response()->json([
            'message' => 'Post creado con exito',
            'data' => $post
        ], 201);
    }

    public function update(Request $request, Post $post): JsonResponse
    {
        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
            'publicado' => 'boolean'
        ]);

        $postActualizado = $this->postService->updatePost($post, $validated);

        return response()->json([
            'message' => 'Post actualizado con exito',
            'data' => $postActualizado
        ]);
    }

    public function destroy(Post $post): JsonResponse
    {
        $this->postService->deletePost($post);
        return response()->json(['message' => 'Post eliminado'], 200);
    }
}
