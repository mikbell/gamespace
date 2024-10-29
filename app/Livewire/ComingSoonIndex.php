<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Traits\LoadGamesTrait;

class ComingSoonIndex extends Component
{
    use LoadGamesTrait;

    public array $comingSoon = [];
    public bool $isLoading = false;
    public int $currentPage = 1; // Aggiungi proprietà per la pagina corrente
    public int $perPage = 24; // Elementi per pagina

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
                fields name, cover.url, first_release_date, rating, platforms.abbreviation, slug;
                where (first_release_date >= {$now} & hypes > 5);
                sort rating desc;
                limit {$this->perPage};
                offset {$offset};
            ";

            $comingSoonRaw = $this->makeRequest('games', $query);
            $this->comingSoon = $this->formatForView($comingSoonRaw);

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
        return view('livewire.coming-soon-index', [
            'isLoading' => $this->isLoading,
            'comingSoon' => $this->comingSoon,
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
