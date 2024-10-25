<?php

namespace App\Livewire;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Livewire\Component;
use App\Traits\LoadGamesTrait;

class MostAnticipated extends Component
{
    use LoadGamesTrait;

    public array $mostAnticipated = [];

    public function mount()
    {
        $this->load();
    }
    public function load()
    {
        $current = Carbon::now()->timestamp;
        $afterSixMonths = Carbon::now()->addMonths(6)->timestamp;


        $body = "fields name, cover.url, hypes, first_release_date, slug;
                where (first_release_date >= {$current} & first_release_date < {$afterSixMonths});
                sort hypes desc;
                limit 4;";

        $this->mostAnticipated = $this->makeRequest('games', $body);

        $this->mostAnticipated = $this->formatForView($this->mostAnticipated);
    }

    public function render()
    {
        return view('livewire.most-anticipated');
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => str_replace('thumb', 'cover_small', $game['cover']['url']) ?? null,
                'releaseDate' => Carbon::parse($game['first_release_date'])->format('M d, Y')
            ]);
        })->toArray();
    }
}
