<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Ruta para mostrar el formulario de inicio de sesión
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.show');

// Ruta para mostrar el formulario de registro
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register.show');

// Ruta para procesar el registro
Route::post('/register', [LoginController::class, 'register'])->name('register');

// Ruta para procesar el inicio de sesión
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Ruta para procesar el cerrar sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Agrupar todas las rutas del controlador TaskController
Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class);
});
