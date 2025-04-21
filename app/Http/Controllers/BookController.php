<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Показать список всех книг текущего пользователя.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Для доступа к библиотеке необходимо авторизоваться.');
        }
        $books = $user->books()->orderBy('created_at', 'desc')->get();
        
        return view('books.index', [
            'books'  => $books,
            'filter' => 'all'
        ]);
    }

    /**
     * Показать форму для добавления новой книги.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Обработать отправку формы и сохранить новую книгу.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'year'        => 'required|integer',
            'genre'       => 'required|string|max:100',
            'cover'       => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Книга добавлена успешно!');
    }

    /**
     * Показать форму редактирования книги.
     */
    public function edit($id)
    {
        $user = Auth::user();
        $book = $user->books()->find($id);
        if (!$book) {
            abort(404);
        }
        return view('books.edit', ['book' => $book]);
    }

    /**
     * Обновить данные книги.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $book = $user->books()->find($id);
        if (!$book) {
            abort(404);
        }
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'year'        => 'required|integer',
            'genre'       => 'required|string|max:100',
            'cover'       => 'nullable|url',
            'description' => 'nullable|string',
        ]);
        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'Книга обновлена успешно!');
    }

    /**
     * Удалить книгу.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $book = $user->books()->find($id);
        if (!$book) {
            abort(404);
        }
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Книга удалена успешно!');
    }

    /**
     * Пометить книгу как прочитанную.
     */
    public function markAsRead($id)
    {
        $user = Auth::user();
        $book = $user->books()->find($id);
        if (!$book) {
            abort(404);
        }
        $book->is_read = true;
        $book->save();
        return redirect()->back()->with('success', 'Книга отмечена как прочитанная.');
    }

    /**
     * Пометить книгу как избранную.
     */
    public function markAsFavorite($id)
    {
        $user = Auth::user();
        $book = $user->books()->find($id);
        if (!$book) {
            abort(404);
        }
        $book->is_favorite = true;
        $book->save();
        return redirect()->back()->with('success', 'Книга добавлена в избранное.');
    }

    /**
     * Показать список прочитанных книг.
     */
    public function showRead()
    {
        $user = Auth::user();
        $books = $user->books()->where('is_read', true)->orderBy('title')->get();
        return view('books.index', [
            'books'  => $books,
            'filter' => 'read'
        ]);
    }

    /**
     * Показать список избранных книг.
     */
    public function showFavorites()
    {
        $user = Auth::user();
        $books = $user->books()->where('is_favorite', true)->orderBy('title')->get();
        return view('books.index', [
            'books'  => $books,
            'filter' => 'fav'
        ]);
    }
}
