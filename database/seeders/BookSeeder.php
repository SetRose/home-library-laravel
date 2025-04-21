<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\User;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Предполагаем, что уже существует хотя бы один пользователь (например, из UserSeeder)
                $user = User::first();

                // Создаем несколько книг для этого пользователя
                Book::create([
                    'title' => 'Война и мир',
                    'author' => 'Лев Толстой',
                    'year' => 1869,
                    'genre' => 'Роман',
                    'is_read' => true,      // допустим, эту книгу пользователь уже прочитал
                    'is_favorite' => false,
                    'user_id' => $user->id
                ]);
        
                Book::create([
                    'title' => '1984',
                    'author' => 'Джордж Оруэлл',
                    'year' => 1949,
                    'genre' => 'Антиутопия',
                    'is_read' => false,
                    'is_favorite' => true,  // эту книгу пометили как избранную
                    'user_id' => $user->id
                ]);
        
                Book::create([
                    'title' => 'Чистый код',
                    'author' => 'Роберт Мартин',
                    'year' => 2008,
                    'genre' => 'IT',
                    'is_read' => false,
                    'is_favorite' => false,
                    'user_id' => $user->id
                ]);
    }
}
