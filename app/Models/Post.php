<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Field yang boleh diisi secara mass assignment
    protected $fillable = [
        'title',
        'content',
        'author',
        'is_published'
    ];

    // Cast tipe data
    protected $casts = [
        'is_published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}