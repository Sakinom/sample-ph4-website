<?php

namespace App\Providers;

use App\Services\YouTubeSearchService;
use App\Services\SpotifySearchService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(YouTubeSearchService::class, function ($app) {
            return new YouTubeSearchService(env('GOOGLE_DEVELOPER_KEY'));
        });

        $this->app->singleton(SpotifySearchService::class, function ($app) {
            return new SpotifySearchService(
                env('SPOTIFY_CLIENT_ID'),
                env('SPOTIFY_CLIENT_SECRET'),
                config('services.spotify.token_endpoint')
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
