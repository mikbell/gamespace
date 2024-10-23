<?php 

namespace App\Traits;

use GuzzleHttp\Client;

trait LoadGamesTrait
{
    protected $client;
    protected $accessToken;
    protected $clientId;

    public function initializeLoadGamesTrait()
    {
        $this->client = new Client();
        $this->accessToken = env('IGDB_ACCESS_TOKEN');
        $this->clientId = env('IGDB_CLIENT_ID');
    }

    private function makeRequest(string $endpoint, string $query)
    {
        try {
            $response = $this->client->request('POST', "https://api.igdb.com/v4/{$endpoint}", [
                'headers' => [
                    'Client-ID' => $this->clientId,
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
                'body' => $query,
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // Log dell'errore per debug e ritorno di un array vuoto
            \Log::error("IGDB API Request failed: " . $e->getMessage());
            return [];
        }
    }
}