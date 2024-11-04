<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Traits\LoadGamesTrait;

class RecentlyReviewedIndex extends Component
{
    use LoadGamesTrait;

    public array $recentlyReviewed = [];
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
        $current = Carbon::now()->timestamp;
        $offset = ($this->currentPage - 1) * $this->perPage;

        try {
            $query = "
                fields name, cover.url, id, first_release_date, rating, rating_count, total_rating_count, platforms.abbreviation, slug;
                where (first_release_date > {$before} & first_release_date < {$current} & rating_count > 5 & cover != null);
                sort total_rating_count desc;
                limit {$this->perPage};
                offset {$offset};
            ";

            $recentlyReviewedRaw = $this->makeRequest('games', $query);
            $newGames = $this->formatForView($recentlyReviewedRaw);

            // Filtra i duplicati per ID
            $this->recentlyReviewed = collect(array_merge($this->recentlyReviewed, $newGames))
                ->unique('id')
                ->values()
                ->toArray();

            // Verifica se ci sono più pagine
            if (count($newGames) < $this->perPage) {
                $this->hasMorePages = false;
            }

        } catch (\Exception $e) {
            $this->dispatch('data-load-error', ['message' => 'Unable to load all games.']);
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
        return view('livewire.recently-reviewed-index', [
            'isLoading' => $this->isLoading,
            'recentlyReviewed' => $this->recentlyReviewed,
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
                'releaseDate' => isset($game['first_release_date']) ? Carbon::createFromTimestamp($game['first_release_date'])->format('M d, Y') : 'N/A',
            ]);
        })->toArray();
    }
}
