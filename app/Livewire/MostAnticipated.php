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
    }

    public function render()
    {
        return view('livewire.most-anticipated');
    }
}
