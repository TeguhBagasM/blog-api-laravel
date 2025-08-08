<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    // GET /api/posts - Ambil semua artikel
    public function index(): JsonResponse
    {
        $posts = Post::all();

        return response()->json([
            'success' => true,
            'message' => 'Data artikel berhasil diambil',
            'data' => $posts
        ]);
    }

    // GET /api/posts/{id} - Ambil satu artikel
    public function show($id): JsonResponse
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail artikel berhasil diambil',
            'data' => $post
        ]);
    }

    // POST /api/posts - Buat artikel baru
    public function store(Request $request): JsonResponse
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'is_published' => 'boolean'
        ]);

        // Buat artikel baru
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'is_published' => $request->is_published ?? false
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil dibuat',
            'data' => $post
        ], 201);
    }

    // PUT /api/posts/{id} - Update artikel
    public function update(Request $request, $id): JsonResponse
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }

        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'is_published' => 'boolean'
        ]);

        // Update artikel
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'is_published' => $request->is_published ?? $post->is_published
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil diperbarui',
            'data' => $post
        ]);
    }

    // DELETE /api/posts/{id} - Hapus artikel
    public function destroy($id): JsonResponse
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil dihapus'
        ]);
    }
}