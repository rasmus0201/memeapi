<?php

namespace Bundsgaard\MemeFetcher;

use Illuminate\Support\ServiceProvider;

class MemeFetcherServiceProvider extends ServiceProvider
{
    /**
     * Boot the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/memefetcher.php' => $this->app->basePath() . '/config/memefetcher.php'
        ], 'config');
    }

   /**
    * Register the application services.
    *
    * @return void
    */
    public function register()
    {
        // $this->app->bind(MemeRepositoryInterface::class, MemeApiRepository::class);
        // $this->app->bind(MemeRepositoryInterface::class, MemeloadApiRepository::class);
    }
}
