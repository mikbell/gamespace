<?php

namespace App\Http\Controllers;

use App\Traits\LoadGamesTrait;
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
        // Inizializzazione manuale per il trait se necessaria
        $this->initializeLoadGamesTrait();

        $game = $this->fetchGameData($slug);

        if (empty($game)) {
            // Gestire il caso in cui il gioco non viene trovato
            abort(404, 'Game not found');
        }

        $game = $this->formatForView($game);

        return view('show', [
            'game' => $game[0] ?? [] // Assicurati di avere un array per la vista
        ]);
    }

    private function fetchGameData($slug)
    {
        $query = "
            fields name, cover.url, genres.name, involved_companies.company.name,
            platforms.abbreviation, summary, videos.video_id, rating, first_release_date,
            screenshots.url, similar_games.name, similar_games.cover.url, similar_games.slug,
            similar_games.platforms.abbreviation, websites.url, aggregated_rating;
            where slug = \"{$slug}\";
        ";

        return $this->makeRequest('games', $query);
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => isset($game['cover']['url']) ? str_replace('thumb', 'cover_big', $game['cover']['url']) : asset('images/default-cover.png'),
                'genres' => isset($game['genres']) ? collect($game['genres'])->pluck('name')->implode(', ') : 'N/A',
                'involvedCompanies' => isset($game['involved_companies']) ? collect($game['involved_companies'])->pluck('company.name')->implode(', ') : 'N/A',
                'platforms' => isset($game['platforms']) ? collect($game['platforms'])->pluck('abbreviation')->implode(', ') : 'N/A',
                'memberRating' => isset($game['rating']) ? round($game['rating']) . '%' : '0%',
                'criticRating' => isset($game['aggregated_rating']) ? round($game['aggregated_rating']) . '%' : '0%',
                'trailer' => isset($game['videos']) && count($game['videos']) > 0 ? 'https://www.youtube.com/watch?v=' . $game['videos'][0]['video_id'] : null,
                'screenshots' => isset($game['screenshots']) && count($game['screenshots']) > 0 ? collect($game['screenshots'])->map(function ($screenshot) {
                    return [
                        'big' => str_replace('thumb', 'screenshot_big', $screenshot['url']),
                        'huge' => str_replace('thumb', 'screenshot_huge', $screenshot['url']),
                    ];
                })->take(9) : collect(),
                'similarGames' => isset($game['similar_games']) && count($game['similar_games']) > 0 ? collect($game['similar_games'])->map(function ($similarGame) {
                    return collect($similarGame)->merge([
                        'coverImageUrl' => isset($similarGame['cover']['url']) ? str_replace('thumb', 'cover_big', $similarGame['cover']['url']) : null,
                        'platforms' => isset($similarGame['platforms']) ? collect($similarGame['platforms'])->pluck('abbreviation')->implode(', ') : 'N/A',
                    ]);
                })->take(6) : collect(),
                'social' => [
                    'website' => collect($game['websites'])->first() ?? null,
                    'instagram' => collect($game['websites'])->firstWhere('url', fn($url) => str_contains($url, 'instagram')) ?? null,
                    'facebook' => collect($game['websites'])->firstWhere('url', fn($url) => str_contains($url, 'facebook')) ?? null,
                    'twitter' => collect($game['websites'])->firstWhere('url', fn($url) => str_contains($url, 'twitter')) ?? null,
                ],
            ]);
        })->toArray();
    }
}
