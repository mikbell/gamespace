<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Traits\LoadGamesTrait;

class ComingSoon extends Component
{
    use LoadGamesTrait;

    public array $comingSoon = [];

    public function load()
    {
        $now = Carbon::now()->timestamp;
        $afterSixMonths = Carbon::now()->addMonths(6)->timestamp;

        $query = "
                fields name, cover.url, first_release_date, slug, hypes;
                where (first_release_date >= {$now} & first_release_date < {$afterSixMonths} & hypes > 5);
                sort hypes desc;
                limit 4;
            ";

        $this->comingSoon = $this->makeRequest('games', $query);

        $this->comingSoon = $this->formatForView($this->comingSoon);
    }

    public function render()
    {
        return view('livewire.coming-soon');
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => str_replace('thumb', 'cover_small', $game['cover']['url']) ?? asset('images/default-cover.png'),
                'releaseDate' => Carbon::parse($game['first_release_date'])->format('M d, Y')
            ]);
        })->toArray();
    }
}
