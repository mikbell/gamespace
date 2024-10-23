<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Traits\LoadGamesTrait;

class PopularGames extends Component
{
    use LoadGamesTrait;
    public function mount()
    {
        $this->load();
    }
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
    
        $this->popularGames = $this->makeRequest('games', $query);
    }
    

    public function render()
    {
        return view('livewire.popular-games');
    }
}
