<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\ReviewController;

Route::get('/', [GamesController::class, 'dashboard'])->name('dashboard');
Route::get('/games', [GamesController::class, 'index'])->name('games.index');
Route::get('/coming-soon', [GamesController::class, 'comingSoon'])->name('games.coming-soon');
Route::get('/games/{slug}', [GamesController::class, 'show'])->name('games.show');


require __DIR__ . '/auth.php';

Auth::routes();

