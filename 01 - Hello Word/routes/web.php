<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::delete('/', function () {
    echo '';
});

Route::get('/user/{id}', [
    UserController::class,
    'findUserByID'
]);
