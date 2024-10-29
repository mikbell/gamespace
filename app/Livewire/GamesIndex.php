<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Traits\LoadGamesTrait;

class GamesIndex extends Component
{
    use LoadGamesTrait;

    public array $allGames = [];
    public bool $isLoading = false;

    protected $listeners = [
        'dataLoadError' => 'handleDataLoadError',
    ];

    public function load(int $limit = 96) // imposta un limite ragionevole per non sovraccaricare la richiesta
    {
        $this->isLoading = true; // Inizia il caricamento

        $now = Carbon::now()->timestamp;


        try {
            $query = "
                fields name, cover.url, first_release_date, rating, platforms.abbreviation, slug;
                where (first_release_date < {$now});
                sort rating desc;
                limit {$limit};
            ";

            $allGamesRaw = $this->makeRequest('games', $query);
            $this->allGames = $this->formatForView($allGamesRaw);

            collect($this->allGames)->filter(function ($game) {
                return isset($game['rating']);
            })->each(function ($game) {
                // Logga il valore di rating per confermare che esiste e che è corretto
                \Log::info('Emettendo evento per gioco con rating: ', ['rating' => $game['rating']]);

                // Passa il valore del rating come parte di un array associativo
                $this->dispatch('gameWithRatingAdded', [
                    'slug' => $game['slug'],
                    'rating' => $game['rating'],
                ]);
            });

        } catch (\Exception $e) {
            $this->dispatch('data-load-error', ['message' => 'Unable to load all games.']);
        } finally {
            $this->isLoading = false; // Ferma il caricamento
        }
    }

    public function handleDataLoadError($message)
    {
        session()->flash('error', $message);
    }

    public function render()
    {
        return view('livewire.games-index', ['isLoading' => $this->isLoading]);
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => isset($game['cover']['url']) ? str_replace('thumb', 'cover_big', $game['cover']['url']) : asset('images/default-cover.png'),
                'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', '),
                'rating' => isset($game['rating']) ? round($game['rating']) : null
            ]);
        })->toArray();
    }
}