<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Traits\LoadGamesTrait;

class PopularGamesIndex extends Component
{
    use LoadGamesTrait;

    public array $popularGames = [];
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
        $before = Carbon::now()->subMonths(2)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;
        $offset = ($this->currentPage - 1) * $this->perPage; // Calcola l'offset

        try {
            $query = "
                fields name, cover.url, first_release_date, rating, platforms.abbreviation, slug;
                where (first_release_date > {$before} & first_release_date < {$after});
                sort rating desc;
                limit {$this->perPage};
                offset {$offset};
            ";

            $popularGamesRaw = $this->makeRequest('games', $query);
            $this->popularGames = $this->formatForView($popularGamesRaw);

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
        return view('livewire.popular-games-index', [
            'isLoading' => $this->isLoading,
            'popularGames' => $this->popularGames,
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
