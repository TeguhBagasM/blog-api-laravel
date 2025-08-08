<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Primary key auto increment
            $table->string('title'); // Judul artikel
            $table->text('content'); // Isi artikel
            $table->string('author'); // Penulis artikel
            $table->boolean('is_published')->default(false); // Status publish
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};