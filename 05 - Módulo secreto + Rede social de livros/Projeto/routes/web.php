<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.home');
})->name('home');

Route::post('/register', [UserController::class, 'register'])->name('user.register');

Route::prefix('login')->group(function () {
    Route::post('/', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::put('/', [UserController::class, 'update'])->name('user.update');
    Route::patch('/password', [UserController::class, 'updatePassword'])->name('user.update.passsword');
    Route::patch('/photo', [UserController::class, 'updatePhoto'])->name('user.update.photo');
});


