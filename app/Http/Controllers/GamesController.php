<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IGDBService;

class GamesController extends Controller
{
    // protected $igdbService;

    // public function __construct(IGDBService $igdbService)
    // {
    //     $this->igdbService = $igdbService;
    // }

    public function index()
    {
        // $popularGames = $this->igdbService->getPopularGames();
        // $recentlyReviewed = $this->igdbService->getRecentlyReviewed();
        // $mostAnticipated = $this->igdbService->getMostAnticipated();
        // $comingSoon = $this->igdbService->getComingSoon();

        return view('games.index', [
            // 'popularGames' => $popularGames,
            // 'recentlyReviewed' => $recentlyReviewed,
            // 'mostAnticipated' => $mostAnticipated,
            // 'comingSoon' => $comingSoon
        ]);
    }
}
