<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return response()->json('pong');
});

Route::prefix('/games')->group(function () {
    Route::get('/', [GameController::class, 'index'])->name('games.index');
    Route::get('/{id}', [GameController::class, 'show'])->name('games.show')->whereNumber('id');
    Route::delete('/{id}', [GameController::class, 'delete'])->name('games.delete')->whereNumber('id');
    Route::post('/', [GameController::class, 'store'])->name('games.store');
    Route::put('/{id}', [GameController::class, 'update'])->name('games.update')->whereNumber('id');
});

//REQUEST => MIDLEWARE => CONTROLLER => RESPONSE