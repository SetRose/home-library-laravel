<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Разрешенные для массового заполнения (mass assignment) поля:
    protected $fillable = [
        'title',
        'author',
        'year',
        'genre',
        'cover',
        'description',
        'is_read',
        'is_favorite',
        'user_id'

    ];

    /**
     * Получить пользователя-владельца данной книги
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
