<?php

namespace App\Services;

use Google_Client;
use Google_Service_YouTube;

class YouTubeSearchService
{
  private Google_Client $youtubeClient;
  private Google_Service_YouTube $youtubeService;

  public function __construct(string $developerKey)
  {
    $this->youtubeClient = new Google_Client();
    $this->youtubeClient->setDeveloperKey($developerKey);
    $this->youtubeService = new Google_Service_YouTube($this->youtubeClient);
  }

  public function search(string $query, int $maxResults)
  {
    return $this->youtubeService->search->listSearch('id, snippet', [
      'q' => $query,
      'maxResults' => $maxResults,
      'type' => 'video',
    ])->toSimpleObject();
  }
}
