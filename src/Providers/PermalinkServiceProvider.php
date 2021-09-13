<?php

namespace Latus\Permalink\Providers;

use Illuminate\Support\ServiceProvider;

class PermalinkServiceProvider extends ServiceProvider
{
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