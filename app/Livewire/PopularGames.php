<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Traits\LoadGamesTrait;

class PopularGames extends Component
{
    use LoadGamesTrait;

    public array $popularGames = [];

    public function load(int $limit = 12)
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;

        $query = "
            fields name, cover.url, first_release_date, rating, platforms.abbreviation, slug;
            where (first_release_date > {$before} & first_release_date < {$after});
            sort rating desc;
            limit {$limit};
        ";

        $popularGamesRaw = $this->makeRequest('games', $query);

        $this->popularGames = $this->formatForView($popularGamesRaw);
    }


    public function render()
    {
        return view('livewire.popular-games');
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => isset($game['cover']['url']) ? str_replace('thumb', 'cover_big', $game['cover']['url']) : null,
                'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', '),
                'rating' => isset($game['rating']) ? round($game['rating']) . '%' : null
            ]);
        })->toArray();
    }
}

