<?php

namespace App\Livewire;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Livewire\Component;

class RecentlyReviewed extends Component
{
    public array $recentlyReviewed = [];

    protected $client;
    protected $accessToken;
    protected $clientId;
    public function mount()
    {
        // Inizializza i valori al montaggio del componente
        $this->client = new Client();
        $this->accessToken = env('IGDB_ACCESS_TOKEN');
        $this->clientId = env('IGDB_CLIENT_ID');

        // Carica i giochi popolari all'avvio del componente
        $this->loadRecentlyReviewed();
    }

    public function loadRecentlyReviewed()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $current = Carbon::now()->timestamp;

        try {
            $response = $this->client->request('POST', 'https://api.igdb.com/v4/games', [
                'headers' => [
                    'Client-ID' => $this->clientId,
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
                'body' => "
                fields name, cover.url, summary, first_release_date, rating, rating_count, platforms.abbreviation;
                where (first_release_date > {$before} & first_release_date < {$current} & rating_count > 10);
                limit 3;
            "
            ]);

            $this->recentlyReviewed = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            \Log::error("Error fetching recently reviewed games: " . $e->getMessage());
            $this->recentlyReviewed = []; // Array vuoto se qualcosa va storto
        }
    }

    public function render()
    {
        return view('livewire.recently-reviewed');
    }
}
