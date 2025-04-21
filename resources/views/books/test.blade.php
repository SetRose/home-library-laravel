<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Тест Navbar</title>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <style>
    body { margin: 0; padding: 0; background: #eee; }
    /* Простой navbar без flex и других правил */
    .navbar {
      background-color: #F5F5F5 !important;
      position: static; /* или используйте sticky сверху */
      padding: 1rem;
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <div class="container">
      <a class="navbar-brand" href="#">Тестовая шапка</a>
    </div>
  </nav>
  <div class="container">
    <p>Если шапка здесь сверху — значит базовый HTML и navbar работают правильно.</p>
  </div>
</body>
</html>
