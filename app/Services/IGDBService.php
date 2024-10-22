<?php

namespace App\Services;

use GuzzleHttp\Client;
use Carbon\Carbon;

class IGDBService
{
    // protected $client;
    // protected $accessToken;
    // protected $clientId;

    // public function __construct()
    // {
    //     $this->client = new Client();
    //     $this->accessToken = env('IGDB_ACCESS_TOKEN');
    //     $this->clientId = env('IGDB_CLIENT_ID');
    // }

    // public function getPopularGames()
    // {
    //     $before = Carbon::now()->subMonths(2)->timestamp;
    //     $after = Carbon::now()->addMonths(2)->timestamp;

    //     $response = $this->client->request('POST', 'https://api.igdb.com/v4/games', [
    //         'headers' => [
    //             'Client-ID' => $this->clientId,
    //             'Authorization' => 'Bearer ' . $this->accessToken,
    //         ],
    //         'body' => "
    //             fields name, cover.url, first_release_date, rating, platforms.abbreviation;
    //             where (first_release_date > {$before} & first_release_date < {$after});
    //             sort rating desc;
    //             limit 12;
    //         "
    //     ]);

    //     return json_decode($response->getBody(), true);
    // }


    // public function getRecentlyReviewed()
    // {
    //     $before = Carbon::now()->subMonths(2)->timestamp;
    //     $current = Carbon::now()->timestamp;

    //     $response = $this->client->request('POST', 'https://api.igdb.com/v4/games', [
    //         'headers' => [
    //             'Client-ID' => $this->clientId,
    //             'Authorization' => 'Bearer ' . $this->accessToken,
    //         ],
    //         'body' => "
    //             fields name, cover.url, summary, first_release_date, rating, rating_count, platforms.abbreviation;
    //             where (first_release_date > {$before} & first_release_date < {$current} & rating_count > 10);
    //             limit 3;
    //         "
    //     ]);

    //     return json_decode($response->getBody(), true);
    // }

    // public function getMostAnticipated()
    // {
    //     $current = Carbon::now()->timestamp;
    //     $afterSixMonths = Carbon::now()->addMonths(6)->timestamp;

    //     $response = $this->client->request('POST', 'https://api.igdb.com/v4/games', [
    //         'headers' => [
    //             'Client-ID' => $this->clientId,
    //             'Authorization' => 'Bearer ' . $this->accessToken,
    //         ],
    //         'body' => "
    //             fields name, cover.url, hypes, first_release_date, rating, platforms.abbreviation;
    //             where (first_release_date >= {$current} & first_release_date < {$afterSixMonths});
    //             sort hypes desc;
    //             limit 4;
    //         "
    //     ]);

    //     return json_decode($response->getBody(), true);
    // }

    // public function getComingSoon()
    // {
    //     $current = Carbon::now()->timestamp;

    //     $response = $this->client->request('POST', 'https://api.igdb.com/v4/games', [
    //         'headers' => [
    //             'Client-ID' => $this->clientId,
    //             'Authorization' => 'Bearer ' . $this->accessToken,
    //         ],
    //         'body' => "
    //             fields name, cover.url, hypes, first_release_date, rating, platforms.abbreviation;
    //             where (first_release_date >= {$current} & hypes > 5);
    //             limit 4;
    //         "
    //     ]);

    //     return json_decode($response->getBody(), true);
    // }
}