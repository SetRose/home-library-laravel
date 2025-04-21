<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Домашняя библиотека</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

  <!-- Scripts (Laravel + Vite) -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <!-- Дополнительные стили -->
  <style>
    /* Сбрасываем отступы у html и body */
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
    }
    /* Лёгкая текстура фона */
    body {
      background: #fcfcfc url("https://www.transparenttextures.com/patterns/paper.png");
      background-repeat: repeat;
    }
    /* Фиксируем navbar сверху */
    .navbar {
      background-color: #F5F5F5 !important;
      color: #333;
      position: fixed;   /* Зафиксированная позиция */
      top: 0;            /* Прилеплен к верху экрана */
      left: 0;
      width: 100%;       /* Растягиваем на всю ширину */
      z-index: 1030;     /* Поверх остального контента */
      margin: 0;
    }
    .navbar .navbar-brand,
    .navbar .nav-link {
      color: #333 !important;
    }
    .navbar .nav-link:hover {
      color: #000 !important;
    }

    /*
     * ВАЖНО: основной контент должен отступать от верхнего края,
     * чтобы не залезать под фиксированный navbar.
     * Допустим, сам navbar по высоте около 56px, добавим чуть больше (70px).
     */
    main {
      margin-top: 70px; /* Отступ сверху, чтобы шапка не перекрывала контент */
    }
  </style>
</head>
<body>
  <div id="app">
    <!-- Фиксированный NAVBAR -->
    <nav class="navbar navbar-expand-md shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          Домашняя библиотека
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Левая часть (если требуется меню) -->
          <ul class="navbar-nav me-auto">
            {{-- Дополнительные пункты меню --}}
          </ul>

          <!-- Правая часть: логин/регистрация/профиль -->
          <ul class="navbar-nav ms-auto">
            @guest
              @if (Route::has('login'))
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">Войти</a>
                </li>
              @endif
              @if (Route::has('register'))
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                </li>
              @endif
            @else
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                   role="button" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-end"
                     aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                    Выйти
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}"
                        method="POST" class="d-none">
                    @csrf
                  </form>
                </div>
              </li>
            @endguest
          </ul>
        </div><!-- /.collapse -->
      </div><!-- /.container -->
    </nav>

    <!-- ОСНОВНОЙ КОНТЕНТ (с отступом сверху) -->
    <main class="py-4">
      @yield('content')
    </main>
  </div><!-- /#app -->
</body>
</html>
