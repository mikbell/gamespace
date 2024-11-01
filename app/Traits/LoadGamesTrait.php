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
        $this->clientId = env('IGDB_CLIENT_ID');
        $this->accessToken = env('IGDB_ACCESS_TOKEN');

        if (is_null($this->clientId) || is_null($this->accessToken)) {
            throw new \Exception('IGDB_CLIENT_ID o IGDB_ACCESS_TOKEN non è impostato nell\'ambiente.');
        }
    }

    protected function getClient()
    {
        return $this->client ??= new Client();
    }

    private function makeRequest(string $endpoint, string $query)
    {
        $cacheKey = $this->generateCacheKey($endpoint, $query);

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            \Log::info("Invio richiesta a IGDB", ['endpoint' => $endpoint, 'query' => $query]);

            $response = $this->getClient()->request('POST', "https://api.igdb.com/v4/{$endpoint}", [
                'headers' => [
                    'Client-ID' => $this->clientId,
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
                'body' => $query,
            ]);

            $data = json_decode($response->getBody(), true);

            if (!empty($data)) {
                Cache::put($cacheKey, $data, now()->addMinutes(10)); // Caching per 10 minuti
                \Log::info("Risposta da IGDB salvata nella cache", ['response' => $data]);
            }

            return $data;
        } catch (\Exception $e) {
            \Log::error("Errore nella richiesta a IGDB: " . $e->getMessage());
            return [];
        }
    }

    private function generateCacheKey(string $endpoint, string $query)
    {
        return md5("igdb_{$endpoint}_" . $query);
    }
}
