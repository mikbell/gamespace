<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Traits\LoadGamesTrait;

class PopularGames extends Component
{
    use LoadGamesTrait;

    public array $popularGames = [];
    public bool $isLoading = false;

    protected $listeners = [
        'dataLoadError' => 'handleDataLoadError',
    ];

    public function load(int $limit = 12)
    {
        $this->isLoading = true;

        try {
            $before = Carbon::now()->subMonths(2)->timestamp;
            $now = Carbon::now()->timestamp;

            $query = "
                fields name, cover.url, first_release_date, rating, platforms.abbreviation, slug;
                where (first_release_date > {$before} & first_release_date < {$now});
                sort rating desc;
                limit {$limit};
            ";

            $popularGamesRaw = $this->makeRequest('games', $query);
            $this->popularGames = $this->formatForView($popularGamesRaw);

            collect($this->popularGames)->filter(function ($game) {
                return isset($game['rating']);
            })->each(function ($game) {

                $this->dispatch('gameWithRatingAdded', [
                    'slug' => $game['slug'],
                    'rating' => $game['rating'],
                ]);
            });

        } catch (\Exception $e) {
            $this->dispatch('data-load-error', ['message' => 'Unable to load popular games.']);
        } finally {
            $this->isLoading = false;
        }
    }

    public function handleDataLoadError($message)
    {
        session()->flash('error', $message);
    }

    public function render()
    {
        return view('livewire.popular-games', ['isLoading' => $this->isLoading]);
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

