<?php

namespace Latus\Permalink\Providers;

use Illuminate\Support\ServiceProvider;
use Latus\Permalink\Http\Middleware\SetRequestUri;
use Latus\Permalink\Repositories\Cache\GeneratedPermalinkRepository;
use Latus\Permalink\Repositories\Contracts\PermalinkRepository as PermalinkRepositoryContract;
use Latus\Permalink\Repositories\Eloquent\PermalinkRepository;
use Latus\Permalink\Repositories\Contracts\GeneratedPermalinkRepository as GeneratedPermalinkRepositoryContract;
use Latus\Permalink\Services\GeneratedPermalinkService;

class PermalinkServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (!$this->app->bound(PermalinkRepositoryContract::class)) {
            $this->app->bind(PermalinkRepositoryContract::class, PermalinkRepository::class);
        }

        if (!$this->app->bound(GeneratedPermalinkRepositoryContract::class)) {
            $this->app->bind(GeneratedPermalinkRepositoryContract::class, GeneratedPermalinkRepository::class);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->app->make('router')->aliasMiddleware('set-uri', SetRequestUri::class);
    }
}