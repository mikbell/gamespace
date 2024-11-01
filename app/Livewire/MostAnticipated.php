<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Traits\LoadGamesTrait;

class MostAnticipated extends Component
{
    use LoadGamesTrait;

    public array $mostAnticipated = [];
    public bool $isLoading = false;


    public function load()
    {
        $this->isLoading = true;
        
        $now = Carbon::now()->timestamp;

        $body = "fields name, cover.url, hypes, first_release_date, slug;
                where (first_release_date >= {$now});
                sort hypes desc;
                limit 4;";

        $this->mostAnticipated = $this->makeRequest('games', $body);

        $this->mostAnticipated = $this->formatForView($this->mostAnticipated);

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.most-anticipated');
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
