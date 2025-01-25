<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\WishlistController;

Route::view('/', 'games.dashboard')->name('dashboard');
Route::get('/games/{slug}', [GamesController::class, 'show'])->name('games.show');

Route::view('/popular-games', 'games.popular-games')->name('games.popular-games');
Route::view('/recently-reviewed', 'games.recently-reviewed')->name('games.recently-reviewed');
Route::view('/most-anticipated', 'games.most-anticipated')->name('games.most-anticipated');
Route::view('/coming-soon', 'games.coming-soon')->name('games.coming-soon');
Route::view('/about', 'about')->name('about');


Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
});

require __DIR__ . '/auth.php';

Auth::routes();

