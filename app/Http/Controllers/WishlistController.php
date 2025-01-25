<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Recupera i giochi nella wishlist dell'utente
        $wishlistGames = $user->wishlist;

        return view('wishlist.index', compact('wishlistGames'));
    }
}
