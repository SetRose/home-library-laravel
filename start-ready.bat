@echo off
setlocal
set "PHP=%~dp0php-portable\php.exe"

echo.
echo ================================
echo   Старт «Домашней библиотеки»
echo ================================
echo.

start "" "%PHP%" artisan serve --host=127.0.0.1 --port=8000
echo.
echo Сервер запущен на http://127.0.0.1:8000
pause