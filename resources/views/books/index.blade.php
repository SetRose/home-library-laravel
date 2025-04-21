@extends('layouts.app')

@section('content')
<div class="container">

    @if(isset($filter) && $filter == 'read')
        <h1 class="mb-4">Прочитанные книги</h1>
    @elseif(isset($filter) && $filter == 'fav')
        <h1 class="mb-4">Избранные книги</h1>
    @else
        <h1 class="mb-4">Мои книги</h1>
    @endif

    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Добавить новую книгу</a>

    <div class="mb-2">
        <strong>Фильтр:</strong>
        <a href="{{ route('books.index') }}">Все</a> |
        <a href="{{ route('books.showRead') }}">Прочитанные</a> |
        <a href="{{ route('books.showFavorites') }}">Избранные</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Сетка карточек -->
    <div class="row g-3">

        @forelse($books as $book)
            <div class="col-12 col-md-6 col-lg-4">
                <!-- Карточка книги -->
                <div class="card book-card h-100 p-3 border-0 shadow-sm" style="cursor: default;">
                    <!-- Изображение: именно оно открывает модалку (data-bs-toggle="modal") -->
                    @if($book->cover)
                        <img src="{{ $book->cover }}"
                             class="card-img-top"
                             alt="Обложка книги"
                             style="max-height: 500px; object-fit: contain; background-color: #fdfdfd; cursor: pointer;"
                             data-bs-toggle="modal"
                             data-bs-target="#bookModal-{{ $book->id }}">
                    @else
                        <img src="https://via.placeholder.com/400x500?text=No+Cover"
                             class="card-img-top"
                             alt="Нет обложки"
                             style="max-height: 500px; object-fit: contain; background-color: #fdfdfd; cursor: pointer;"
                             data-bs-toggle="modal"
                             data-bs-target="#bookModal-{{ $book->id }}">
                    @endif

                    <!-- Тело карточки -->
                    <div class="card-body d-flex flex-column mt-2">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text text-muted mb-1">
                            {{ $book->author }} ({{ $book->year }})
                        </p>
                        <p class="card-text small text-muted">
                            {{ $book->genre }}
                        </p>

                        <!-- Кнопки и метки -->
                        <div class="mt-auto">
                            <div class="d-flex flex-wrap gap-2">
                                <!-- Кнопка "Редактировать" -->
                                <a href="{{ route('books.edit', $book->id) }}"
                                   class="btn btn-sm btn-warning fw-bold px-3"
                                   onclick="event.stopPropagation();">
                                    Редактировать
                                </a>

                                <!-- Кнопка "Удалить" -->
                                <form action="{{ route('books.destroy', $book->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Вы уверены, что хотите удалить эту книгу?');"
                                      onclick="event.stopPropagation();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-danger fw-bold px-3">
                                        Удалить
                                    </button>
                                </form>

                                <!-- Прочитать / Прочитано -->
                                @if($book->is_read)
                                    <!-- Метка: стиль "badge", чтобы было понятно, что это статус, а не кнопка -->
                                    <span class="badge rounded-pill text-bg-success px-3 py-2"
                                          style="min-width: 110px;"
                                          onclick="event.stopPropagation();">
                                        Прочитано
                                    </span>
                                @else
                                    <form action="{{ route('books.markRead', $book->id) }}"
                                          method="POST"
                                          onclick="event.stopPropagation();">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-success fw-bold px-3"
                                                style="min-width: 110px;">
                                            Прочитать
                                        </button>
                                    </form>
                                @endif

                                <!-- В избранное / Избранное -->
                                @if($book->is_favorite)
                                    <span class="badge rounded-pill text-bg-primary px-3 py-2"
                                          style="min-width: 110px;"
                                          onclick="event.stopPropagation();">
                                        Избранное
                                    </span>
                                @else
                                    <form action="{{ route('books.markFavorite', $book->id) }}"
                                          method="POST"
                                          onclick="event.stopPropagation();">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-primary fw-bold px-3"
                                                style="min-width: 110px;">
                                            В избранное
                                        </button>
                                    </form>
                                @endif
                            </div><!-- /.d-flex -->
                        </div><!-- /.mt-auto -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->

                <!-- Модалка (детальное описание) -->
                <div class="modal fade"
                     id="bookModal-{{ $book->id }}"
                     tabindex="-1"
                     aria-labelledby="bookModalLabel-{{ $book->id }}"
                     aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="bookModalLabel-{{ $book->id }}">
                            {{ $book->title }}
                        </h5>
                        <button type="button" class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="d-flex flex-column flex-md-row">
                            @if($book->cover)
                                <img src="{{ $book->cover }}"
                                     alt="Обложка книги"
                                     style="max-width: 300px; object-fit: contain;"
                                     class="me-md-4 mb-3 mb-md-0">
                            @endif
                            <div>
                                <p><strong>Автор:</strong> {{ $book->author }}</p>
                                <p><strong>Год:</strong> {{ $book->year }}</p>
                                <p><strong>Жанр:</strong> {{ $book->genre }}</p>
                                @if($book->description)
                                    <p class="mt-3">
                                        <strong>Описание:</strong><br>
                                        {{ $book->description }}
                                    </p>
                                @else
                                    <p class="mt-3 text-muted">Описание не добавлено.</p>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                          Закрыть
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Модалка -->
            </div><!-- /.col -->
        @empty
            <div class="col-12">
                <p class="text-center text-muted">У вас нет добавленных книг.</p>
            </div>
        @endforelse
    </div><!-- /.row -->
</div><!-- /.container -->
@endsection
