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

    public function loadSearchResults(int $limit = 8)
    {
        $this->isLoading = true;

        try {
            if (empty($this->search)) {
                $this->searchResults = [];
                return;
            }

            $query = "
                search \"{$this->search}\";
                fields name, cover.url, slug;
                limit {$limit};
            ";

            $this->searchResults = $this->makeRequest('games', $query);

            $this->searchResults = $this->formatForView($this->searchResults);

        } catch (\Exception $e) {
            $this->dispatch('dataLoadError', ['message' => 'Unable to load search results.']);
        } finally {
            $this->isLoading = false;
        }
    }

    public function handleDataLoadError($message)
    {
        session()->flash('error', $message);
    }

    public function render()
    {
        return view('livewire.search-dropdown', ['isLoading' => $this->isLoading]);
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'name' => $game['name'] ?? null,
                'slug' => $game['slug'] ?? null,
                'coverImageUrl' => str_replace('thumb', 'cover_small', $game['cover']['url'] ?? "https://via.placeholder.com/264x352")
            ]);
        })->toArray();
    }
}
