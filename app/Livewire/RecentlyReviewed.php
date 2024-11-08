<?php

namespace App\Livewire;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Livewire\Component;
use App\Traits\LoadGamesTrait;

class RecentlyReviewed extends Component
{
    use LoadGamesTrait;

    public array $recentlyReviewed = [];


    public function load()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $current = Carbon::now()->timestamp;


        $query = "
                fields name, cover.url, summary, rating_count, first_release_date, rating,
                rating_count, platforms.abbreviation, slug;
                where (first_release_date > {$before} & first_release_date < {$current} & rating_count > 5);
                sort rating_count desc;
                limit 3;
            "
        ;

        $this->recentlyReviewed = $this->makeRequest('games', $query);

        $this->recentlyReviewed = $this->formatForView($this->recentlyReviewed);
    }

    public function render()
    {
        return view('livewire.recently-reviewed');
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => str_replace('thumb', 'cover_big', $game['cover']['url']) ?? asset('images/default-cover.png'),
                'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', '),
                'rating' => isset($game['rating']) ? round($game['rating']) . '%' : null
            ]);
        })->toArray();
    }
}
