<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return response()->json('pong');
});

Route::prefix('/games')->group(function () {
    Route::get('/', [GameController::class, 'index'])->name('games.index');
});
