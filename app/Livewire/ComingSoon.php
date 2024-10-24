<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Traits\LoadGamesTrait;

class ComingSoon extends Component
{
    use LoadGamesTrait;

    public array $comingSoon = [];

    public function mount()
    {
        $this->load();
    }

    public function load()
    {
        $current = Carbon::now()->timestamp;

        $query = "
                fields name, cover.url, first_release_date, slug;
                where (first_release_date >= {$current} & hypes > 5);
                limit 4;
            ";

        $this->comingSoon = $this->makeRequest('games', $query);
    }

    public function render()
    {
        return view('livewire.coming-soon');
    }
}
