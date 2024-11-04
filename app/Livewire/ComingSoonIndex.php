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
    public bool $hasMorePages = true;
    public int $currentPage = 1;
    public int $perPage = 24;

    protected $listeners = [
        'dataLoadError' => 'handleDataLoadError',
    ];

    public function mount()
    {
        $this->load();
    }

    public function load()
    {
        if (!$this->hasMorePages) {
            return;
        }

        $this->isLoading = true;
        $now = Carbon::now()->timestamp;
        $afterSixMonths = Carbon::now()->addMonths(6)->timestamp;
        $offset = ($this->currentPage - 1) * $this->perPage;

        try {
            $query = "
                fields name, cover.url, first_release_date, rating, platforms.abbreviation, slug;
                where (first_release_date >= {$now} & first_release_date < {$afterSixMonths} & hypes > 10);
                sort first_release_date asc;
                limit {$this->perPage};
                offset {$offset};
            ";

            $comingSoonRaw = $this->makeRequest('games', $query);
            $newGames = $this->formatForView($comingSoonRaw);

            // Blocca la paginazione se l'API restituisce meno del numero massimo di giochi
            if (count($newGames) < $this->perPage) {
                $this->hasMorePages = false;
            }

            // Unisci i nuovi giochi alla lista esistente ed elimina i duplicati
            $this->comingSoon = collect($this->comingSoon)
                ->merge($newGames)
                ->unique('id')
                ->values()
                ->toArray();

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('data-load-error', ['message' => 'Unable to load all games.']);
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
        return view('livewire.coming-soon-index', [
            'isLoading' => $this->isLoading,
            'comingSoon' => $this->comingSoon,
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


