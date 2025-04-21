<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;


Route::middleware('auth')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('home');
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    
    Route::post('/books/{id}/read', [BookController::class, 'markAsRead'])->name('books.markRead');
    Route::post('/books/{id}/favorite', [BookController::class, 'markAsFavorite'])->name('books.markFavorite');
    Route::get('/books/read', [BookController::class, 'showRead'])->name('books.showRead');
    Route::get('/books/favorites', [BookController::class, 'showFavorites'])->name('books.showFavorites');
});

Route::get('/test-navbar', function() {
    return view('test');
});


Route::middleware('auth')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('home');
    // здесь можно добавить и другие маршруты, связанные с книгами
});Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
