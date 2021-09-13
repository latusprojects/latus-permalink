<?php

namespace Latus\Permalink\Providers;

use Illuminate\Support\ServiceProvider;
use Latus\Permalink\Repositories\Contracts\PermalinkRepository as PermalinkRepositoryContract;
use Latus\Permalink\Repositories\Eloquent\PermalinkRepository;

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
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}