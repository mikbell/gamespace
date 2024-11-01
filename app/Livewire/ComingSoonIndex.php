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
        if (!$this->hasMorePages) {
            return; // Interrompe il caricamento se non ci sono più pagine
        }

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
            $newGames = $this->formatForView($mostAnticipatedRaw);

            // Blocca la paginazione se l'API restituisce meno del numero massimo di giochi
            if (count($newGames) < $this->perPage) {
                $this->hasMorePages = false;
            }

            // Unisci i nuovi giochi alla lista esistente ed elimina i duplicati
            $this->mostAnticipated = collect(array_merge($this->mostAnticipated, $newGames))
                ->unique('id') // Assicurati che 'id' sia la chiave giusta per l'unicità
                ->values() // Ripristina gli indici dell'array
                ->toArray();

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
                'rating' => isset($game['rating']) ? round($game['rating']) : null
            ]);
        })->toArray();
    }

}

