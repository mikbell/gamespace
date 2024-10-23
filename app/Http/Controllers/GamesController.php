<?php

namespace App\Http\Controllers;

use App\Traits\LoadGamesTrait;
use Illuminate\Http\Request;
use App\Services\IGDBService;

class GamesController extends Controller
{
    use LoadGamesTrait;
    protected $igdbService;

    public function __construct(IGDBService $igdbService)
    {
        $this->igdbService = $igdbService;
    }

    public function index()
    {

        return view('index');
    }

    public function show($slug)
    {
        // Inizializzazione manuale per il trait
        $this->initializeLoadGamesTrait();

        $query = "
            fields name, cover.url, genres.name, involved_companies.company.name, platforms.abbreviation, summary, videos.video_id, rating, first_release_date;
            where slug = \"{$slug}\";
        ";

        $game = $this->makeRequest('games', $query);

        abort_if(!$game, 404);

        return view('show', [
            'game' => $game[0]
        ]);
    }

}
