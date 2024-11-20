<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\YouTubeSearchService;
use App\Services\SpotifySearchService;

class SearchController extends Controller
{
    private YouTubeSearchService $youtubeSearchService;
    private SpotifySearchService $spotifySearchService;

    public function __construct(
        YouTubeSearchService $youtubeSearchService,
        SpotifySearchService $spotifySearchService
    ) {
        $this->youtubeSearchService = $youtubeSearchService;
        $this->spotifySearchService = $spotifySearchService;
    }

    public function index(Request $request)
    {
        $limit = $request->input('maxResults');
        $query = $request->input('q');

        $youtubeResults = $this->youtubeSearchService->search($query, $limit);
        $spotifyResults = $this->spotifySearchService->search($query, $limit);

        return response()->json([
            'youtubeResults' => $youtubeResults,
            'spotifyResults' => $spotifyResults,
        ]);
    }
}
