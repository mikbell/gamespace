<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\ReviewController;

Route::get('/', [GamesController::class, 'dashboard'])->name('dashboard');
Route::get('/games/{slug}', [GamesController::class, 'show'])->name('games.show');

Route::get('/popular-games', [GamesController::class, 'popularGames'])->name('games.popular-games');
Route::get('/recently-reviewed', [GamesController::class, 'recentlyReviewed'])->name('games.recently-reviewed');
Route::get('/most-anticipated', [GamesController::class, 'mostAnticipated'])->name('games.most-anticipated');
Route::get('/coming-soon', [GamesController::class, 'comingSoon'])->name('games.coming-soon');


require __DIR__ . '/auth.php';

Auth::routes();

