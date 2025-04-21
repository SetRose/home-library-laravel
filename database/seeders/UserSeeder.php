<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Создаем тестового пользователя
                User::create([
                    'name' => 'Иван Петров', 
                    'email' => 'ivan@example.com', 
                    'password' => Hash::make('password')  // пароль "password"
                ]);
    }
}
