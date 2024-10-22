<?php

namespace App\Livewire;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Livewire\Component;

class MostAnticipated extends Component
{
    public array $mostAnticipated = [];

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
        $this->loadMostAnticipated();
    }

    public function loadmostAnticipated()
    {
        $current = Carbon::now()->timestamp;
        $afterSixMonths = Carbon::now()->addMonths(6)->timestamp;

        try {
            $response = $this->client->request('POST', 'https://api.igdb.com/v4/games', [
                'headers' => [
                    'Client-ID' => $this->clientId,
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
                'body' => "
                fields name, cover.url, hypes, first_release_date;
                where (first_release_date >= {$current} & first_release_date < {$afterSixMonths});
                sort hypes desc;
                limit 4;
            "
            ]);

            $this->mostAnticipated = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            \Log::error("Error fetching most anticipated games: " . $e->getMessage());
            $this->mostAnticipated = []; // Array vuoto se qualcosa va storto
        }
    }

    public function render()
    {
        return view('livewire.most-anticipated');
    }
}
