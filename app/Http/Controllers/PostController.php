<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class PostController extends BaseController // Extend BaseController
{
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Post::query();

            // Logic pencarian (sama seperti sebelumnya)
            if ($request->has('search')) {
                $search = $request->search;
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            }

            if ($request->has('published')) {
                $published = $request->boolean('published');
                $query->where('is_published', $published);
            }

            // Pagination - default 10 per page
            $perPage = $request->get('per_page', 10);
            $posts = $query->orderBy('created_at', 'desc')->paginate($perPage);

            return response()->json([
                'success' => true,
                'message' => 'Data artikel berhasil diambil',
                'data' => $posts->items(), // Data artikel
                'pagination' => [
                    'current_page' => $posts->currentPage(),
                    'per_page' => $posts->perPage(),
                    'total' => $posts->total(),
                    'last_page' => $posts->lastPage(),
                    'from' => $posts->firstItem(),
                    'to' => $posts->lastItem()
                ]
            ]);

        } catch (\Exception $e) {
            return $this->sendError('Terjadi kesalahan saat mengambil data', [], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $post = Post::find($id);

            if (!$post) {
                return $this->sendError('Artikel tidak ditemukan', [], 404);
            }

            return $this->sendResponse($post, 'Detail artikel berhasil diambil');

        } catch (\Exception $e) {
            return $this->sendError('Terjadi kesalahan saat mengambil detail artikel', [], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'author' => 'required|string|max:255',
                'is_published' => 'boolean'
            ]);

            $post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'author' => $request->author,
                'is_published' => $request->is_published ?? false
            ]);

            return $this->sendResponse($post, 'Artikel berhasil dibuat', 201);

        } catch (ValidationException $e) {
            return $this->sendError('Data tidak valid', $e->errors(), 422);
        } catch (\Exception $e) {
            return $this->sendError('Terjadi kesalahan saat membuat artikel', [], 500);
        }
    }

    // Update method destroy juga
    public function destroy($id): JsonResponse
    {
        try {
            $post = Post::find($id);

            if (!$post) {
                return $this->sendError('Artikel tidak ditemukan', [], 404);
            }

            $post->delete();

            return $this->sendResponse([], 'Artikel berhasil dihapus');

        } catch (\Exception $e) {
            return $this->sendError('Terjadi kesalahan saat menghapus artikel', [], 500);
        }
    }
}