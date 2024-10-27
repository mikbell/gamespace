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

        if (is_null($this->accessToken) || is_null($this->clientId)) {
            throw new \Exception('IGDB_ACCESS_TOKEN or IGDB_CLIENT_ID is not set in the environment.');
        }
    }

    private function makeRequest(string $endpoint, string $query)
    {
        $cacheKey = $this->generateCacheKey($endpoint, $query);

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            \Log::info("Sending request to IGDB", ['endpoint' => $endpoint, 'query' => $query]);

            $response = $this->client->request('POST', "https://api.igdb.com/v4/{$endpoint}", [
                'headers' => [
                    'Client-ID' => $this->clientId,
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
                'body' => $query,
            ]);

            $data = json_decode($response->getBody(), true);
            \Log::info("Response from IGDB", ['response' => $data]);

            // Cache e restituzione dei dati
            Cache::put($cacheKey, $data, now()->addSeconds(7));
            return $data;
        } catch (\Exception $e) {
            \Log::error("IGDB API Request failed: " . $e->getMessage());
            return [];
        }

    }

    private function generateCacheKey(string $endpoint, string $query)
    {
        return md5("igdb_{$endpoint}_" . $query);
    }
}
