<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Info API
Route::get('/', function () {
    return response()->json([
        'message' => 'Selamat datang di Blog API',
        'version' => '1.0',
        'endpoints' => [
            'GET /api/posts' => 'Ambil semua artikel',
            'GET /api/posts/{id}' => 'Ambil artikel tertentu',
            'POST /api/posts' => 'Buat artikel baru',
            'PUT /api/posts/{id}' => 'Update artikel',
            'DELETE /api/posts/{id}' => 'Hapus artikel'
        ]
    ]);
});

// CRUD Routes untuk Posts
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::post('/posts', [PostController::class, 'store']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);