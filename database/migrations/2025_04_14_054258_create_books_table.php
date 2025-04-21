<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('cover')->nullable(); // URL обложки, опционально
            $table->string('title');       // Название книги
            $table->string('author');      // Автор книги
            $table->smallInteger('year');         // Год издания (тип YEAR)
            $table->text('description')->nullable();
            $table->string('genre');       // Жанр книги
            $table->boolean('is_read')->default(false);     // Прочитана ли книга
            $table->boolean('is_favorite')->default(false); // Избранная ли книга
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
