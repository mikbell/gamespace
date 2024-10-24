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
    
    public function mount()
    {
        $this->load();
    }

    public function load()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $current = Carbon::now()->timestamp;


        $query = "
                fields name, cover.url, summary, first_release_date, rating, rating_count, platforms.abbreviation, slug;
                where (first_release_date > {$before} & first_release_date < {$current} & rating_count > 10);
                limit 3;
            "
        ;

        $this->recentlyReviewed = $this->makeRequest('games', $query);

    }

    public function render()
    {
        return view('livewire.recently-reviewed');
    }
}
