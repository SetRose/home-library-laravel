@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактировать книгу</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="title" class="form-label">Название книги</label>
            <input type="text" name="title" id="title" class="form-control"
                   required value="{{ old('title', $book->title) }}">
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Автор</label>
            <input type="text" name="author" id="author" class="form-control"
                   required value="{{ old('author', $book->author) }}">
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Год издания</label>
            <input type="number" name="year" id="year" class="form-control"
                   required value="{{ old('year', $book->year) }}">
        </div>

        <div class="mb-3">
            <label for="genre" class="form-label">Жанр</label>
            <input type="text" name="genre" id="genre" class="form-control"
                   required value="{{ old('genre', $book->genre) }}">
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">URL обложки книги</label>
            <input type="url" name="cover" id="cover" class="form-control"
                   value="{{ old('cover', $book->cover) }}">
        </div>

        <!-- Новое поле description -->
        <div class="mb-3">
            <label for="description" class="form-label">Описание книги</label>
            <textarea name="description" id="description" rows="5"
                      class="form-control">{{ old('description', $book->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Сохранить изменения</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection
