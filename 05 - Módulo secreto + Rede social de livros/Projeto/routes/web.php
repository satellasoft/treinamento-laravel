<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.home');
})->name('home');

Route::prefix('login')->group(function () {
    Route::post('/', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {})->name('dashboard');
});


Route::post('/register', [UserController::class, 'register'])->name('user.register');
