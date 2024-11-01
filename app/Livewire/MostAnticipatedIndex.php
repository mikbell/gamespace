<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Traits\LoadGamesTrait;

class MostAnticipatedIndex extends Component
{
    use LoadGamesTrait;

    public array $mostAnticipated = [];
    public bool $isLoading = false;
    public int $currentPage = 1;
    public int $perPage = 24;

    protected $listeners = [
        'dataLoadError' => 'handleDataLoadError',
    ];

    public function mount()
    {
        $this->load(); // Carica i giochi al montaggio
    }

    public function load() 
    {
        $this->isLoading = true;
        $now = Carbon::now()->timestamp;
        $offset = ($this->currentPage - 1) * $this->perPage; // Calcola l'offset

        try {
            $query = "
                fields name, cover.url, first_release_date, rating, hypes, platforms.abbreviation, slug;
                where (first_release_date >= {$now});
                sort hypes desc;
                limit {$this->perPage};
                offset {$offset};
            ";

            $mostAnticipatedRaw = $this->makeRequest('games', $query);
            $this->mostAnticipated = $this->formatForView($mostAnticipatedRaw);

        } catch (\Exception $e) {
            $this->dispatch('data-load-error', ['message' => 'Unable to load all games.']);
        } finally {
            $this->isLoading = false;
        }
    }

    public function nextPage()
    {
        $this->currentPage++;
        $this->load();
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->load();
        }
    }

    public function handleDataLoadError($message)
    {
        session()->flash('error', $message);
    }

    public function render()
    {
        return view('livewire.most-anticipated-index', [
            'isLoading' => $this->isLoading,
            'mostAnticipated' => $this->mostAnticipated,
            'currentPage' => $this->currentPage
        ]);
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
