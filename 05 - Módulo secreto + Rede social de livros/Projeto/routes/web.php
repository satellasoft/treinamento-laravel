<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.home');
});

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/dashboard', function () {})->name('dashboard');

Route::post('/register', [UserController::class, 'register'])->name('user.register');
