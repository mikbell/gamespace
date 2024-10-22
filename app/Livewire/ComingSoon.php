<?php

namespace App\Livewire;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Livewire\Component;

class ComingSoon extends Component
{
    public array $comingSoon = [];

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
        $this->loadComingSoon();
    }

    public function loadComingSoon()
    {
        $current = Carbon::now()->timestamp;

        try {
            $response = $this->client->request('POST', 'https://api.igdb.com/v4/games', [
                'headers' => [
                    'Client-ID' => $this->clientId,
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
                'body' => "
                fields name, cover.url, first_release_date;
                where (first_release_date >= {$current} & hypes > 5);
                limit 4;
            "
            ]);

            $this->comingSoon = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            \Log::error("Error fetching most anticipated games: " . $e->getMessage());
            $this->comingSoon = []; // Array vuoto se qualcosa va storto
        }
    }
    
    public function render()
    {
        return view('livewire.coming-soon');
    }
}
