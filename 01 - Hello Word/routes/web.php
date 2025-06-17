<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contato', function () {});

Route::post('/user', function () {});

//localhost:8000/user/1/find
Route::get('/user/{id}/find', function (int $id) {
    dd($id);
});









Route::delete('/', function () {
    echo '';
});

Route::get('/user/{id}', [
    UserController::class,
    'findUserByID'
]);
