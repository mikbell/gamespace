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
    public bool $hasMorePages = true;
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
        if (!$this->hasMorePages) {
            return; // Blocca il caricamento se non ci sono più pagine
        }
    
        $before = Carbon::now()->subMonths(2)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;
        $offset = ($this->currentPage - 1) * $this->perPage;
    
        try {
            $query = "
                fields name, cover.url, first_release_date, rating, platforms.abbreviation, slug;
                where (first_release_date > {$before} & first_release_date < {$after} & cover != null);
                sort rating desc;
                limit {$this->perPage};
                offset {$offset};
            ";
    
            $popularGamesRaw = $this->makeRequest('games', $query);
            $newGames = $this->formatForView($popularGamesRaw);
    
            // Filtra per unicità usando l'ID di ogni gioco
            $this->popularGames = collect(array_merge($this->popularGames, $newGames))
                ->unique('id')
                ->values()
                ->toArray();
    
            // Controlla se ci sono più pagine
            if (count($newGames) < $this->perPage) {
                $this->hasMorePages = false;
            }
    
        } catch (\Exception $e) {
            $this->dispatch('dataLoadError', ['message' => 'Unable to load all games.']);
        } finally {
            $this->isLoading = false;
        }
    }

    public function nextPage()
    {
        if ($this->hasMorePages) {
            $this->currentPage++;
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
            'currentPage' => $this->currentPage,
            'hasMorePages' => $this->hasMorePages
        ]);
    }

    private function formatForView($games)
    {
        return collect($games)->unique('id')->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => isset($game['cover']['url']) ? str_replace('thumb', 'cover_big', $game['cover']['url']) : asset('images/default-cover.png'),
                'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', '),
                'rating' => isset($game['rating']) ? round($game['rating']) : null,
                'releaseDate' => isset($game['first_release_date']) ? Carbon::parse($game['first_release_date'])->format('M d, Y') : 'N/A',
            ]);
        })->toArray();
    }
}
