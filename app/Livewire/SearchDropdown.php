<?php

namespace App\Livewire;

use Livewire\Component;
use App\Traits\LoadGamesTrait;

class SearchDropdown extends Component
{
    use LoadGamesTrait;

    public $search = '';
    public $searchResults = [];
    public bool $isLoading = false;

    protected $listeners = [
        'dataLoadError' => 'handleDataLoadError',
    ];

    public function updatedSearch($value)
    {
        if (strlen($value) < 2) {
            $this->resetSearchResults(); // Evita le richieste API se il termine è troppo corto
            return;
        }

        $this->loadSearchResults();
    }

    public function loadSearchResults(int $limit = 8)
    {
        $this->isLoading = true;

        try {
            if (empty($this->search)) {
                $this->resetSearchResults();
                return;
            }

            $query = "
                search \"{$this->search}\";
                fields name, cover.url, slug, rating_count;
                limit {$limit};
            ";

            $this->searchResults = $this->makeRequest('games', $query);
            $this->searchResults = $this->formatForView($this->searchResults);

        } catch (\Exception $e) {
            $this->dispatch('data-load-error', ['message' => 'Impossibile caricare i risultati della ricerca.']);
        } finally {
            $this->isLoading = false;
        }
    }

    public function handleDataLoadError($message)
    {
        session()->flash('error', $message);
    }

    public function resetSearchResults()
    {
        $this->searchResults = [];
        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.search-dropdown', [
            'isLoading' => $this->isLoading,
            'searchResults' => $this->searchResults,
        ]);
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return [
                'name' => $game['name'] ?? null,
                'slug' => $game['slug'] ?? null,
                'coverImageUrl' => isset($game['cover']['url'])
                    ? str_replace('thumb', 'cover_small', $game['cover']['url'])
                    : "https://via.placeholder.com/264x352",
            ];
        })->toArray();
    }
}
