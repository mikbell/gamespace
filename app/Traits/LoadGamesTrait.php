<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

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
        // Generazione della chiave di cache unica in base al tipo di endpoint e query
        $cacheKey = $this->generateCacheKey($endpoint, $query);

        // Controlla se esiste già in cache
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            $response = $this->client->request('POST', "https://api.igdb.com/v4/{$endpoint}", [
                'headers' => [
                    'Client-ID' => $this->clientId,
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
                'body' => $query,
            ]);

            $data = json_decode($response->getBody(), true);

            // Memorizza la risposta in cache per un determinato periodo
            Cache::put($cacheKey, $data, now()->addSeconds(7));

            return $data;
        } catch (\Exception $e) {
            // Log dell'errore per debug e ritorno di un array vuoto
            \Log::error("IGDB API Request failed: " . $e->getMessage());
            return [];
        }
    }

    // Genera una chiave di cache unica
    private function generateCacheKey(string $endpoint, string $query)
    {
        // Genera una chiave hash utilizzando l'endpoint e la query
        return md5("igdb_{$endpoint}_" . $query);
    }
}
