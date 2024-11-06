<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

trait LoadGamesTrait
{
    const IGDB_CLIENT_ID = 'IGDB_CLIENT_ID';
    const IGDB_ACCESS_TOKEN = 'IGDB_ACCESS_TOKEN';

    protected $client;
    protected $accessToken;
    protected $clientId;
    protected $logger;

    public function initializeLoadGamesTrait()
    {
        $this->clientId = env(self::IGDB_CLIENT_ID);
        $this->accessToken = env(self::IGDB_ACCESS_TOKEN);

        if (empty($this->clientId) || empty($this->accessToken)) {
            throw new \Exception('IGDB_CLIENT_ID o IGDB_ACCESS_TOKEN non è impostato nell\'ambiente.');
        }

        $this->client ??= new Client();
        $this->logger ??= new Logger('igdb');
        $this->logger->pushHandler(new StreamHandler(storage_path('logs/igdb.log'), Logger::ERROR));
    }

    private function makeRequest(string $endpoint, string $query)
    {
        if (empty($endpoint) || empty($query)) {
            throw new \Exception('Endpoint o query non possono essere vuoti.');
        }

        $cacheKey = $this->generateCacheKey($endpoint, $query);

        if (Cache::has($cacheKey)) {
            $this->logger->info("Recupero dalla cache", ['cacheKey' => $cacheKey]);
            return Cache::get($cacheKey);
        }

        try {
            $this->logger->info("Invio richiesta a IGDB", ['endpoint' => $endpoint, 'query' => $query]);

            $response = $this->client->request('POST', "https://api.igdb.com/v4/{$endpoint}", [
                'headers' => [
                    'Client-ID' => $this->clientId,
                    'Authorization' => "Bearer {$this->accessToken}",
                ],
                'body' => $query,
            ]);

            $data = json_decode($response->getBody(), true);

            if (!empty($data)) {
                Cache::put($cacheKey, $data, now()->addHours(1)); // Caching per 1 ora
                $this->logger->info("Risposta salvata nella cache", ['cacheKey' => $cacheKey]);
            }

            return $data;
        } catch (\Exception $e) {
            $this->logger->error("Errore nella richiesta a IGDB: " . $e->getMessage());
            return [];
        }
    }

    private function generateCacheKey(string $endpoint, string $query)
    {
        return 'igdb_' . md5("{$endpoint}_{$query}");
    }
}
