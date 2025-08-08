<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 10 artikel sample
        Post::factory(10)->create();

        // Buat artikel manual untuk testing
        Post::create([
            'title' => 'Artikel Pertama Saya',
            'content' => 'Ini adalah artikel pertama yang saya buat menggunakan API Laravel',
            'author' => 'Teguh Bagas',
            'is_published' => true
        ]);
    }
}