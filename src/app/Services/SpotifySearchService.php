<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use SpotifyWebAPI\SpotifyWebAPI;

class SpotifySearchService
{
  private string $tokenEndpoint;

  public function __construct(private string $clientId, private string $clientSecret, string $tokenEndpoint)
  {
    $this->tokenEndpoint = $tokenEndpoint;
  }

  private function getAccessToken(): string
  {
    $response = Http::asForm()->post($this->tokenEndpoint, [
      'grant_type' => 'client_credentials',
      'client_id' => $this->clientId,
      'client_secret' => $this->clientSecret,
    ]);

    return $response->json()['access_token'];
  }

  public function search(string $query, int $limit)
  {
    $spotifyApi = new SpotifyWebAPI();
    $spotifyApi->setAccessToken($this->getAccessToken());

    return $spotifyApi->search($query, 'track', ['limit' => $limit])->tracks->items;
  }
}
