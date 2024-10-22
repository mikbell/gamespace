<?php

namespace App\Livewire;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Livewire\Component;

class PopularGames extends Component
{
    public array $popularGames = [];
    
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
        $this->loadPopularGames();
    }

    public function loadPopularGames()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;

        try {
            $response = $this->client->request('POST', 'https://api.igdb.com/v4/games', [
                'headers' => [
                    'Client-ID' => $this->clientId,
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
                'body' => "
                    fields name, cover.url, first_release_date, rating, platforms.abbreviation;
                    where (first_release_date > {$before} & first_release_date < {$after});
                    sort rating desc;
                    limit 12;
                "
            ]);

            $this->popularGames = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            \Log::error("Error fetching popular games: " . $e->getMessage());
            $this->popularGames = []; // Array vuoto se qualcosa va storto
        }
    }

    public function render()
    {
        return view('livewire.popular-games');
    }
}
