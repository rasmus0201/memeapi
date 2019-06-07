<?php

namespace Bundsgaard\MemeFetcher;

use Illuminate\Support\ServiceProvider;
use Bundsgaard\MemeFetcher\Repositories\MemeApiRepository;
use Bundsgaard\MemeFetcher\Contracts\MemeRepositoryInterface;

class MemeFetcherServiceProvider extends ServiceProvider
{
   /**
    * Register the application services.
    *
    * @return void
    */
    public function register()
    {
        $this->app->bind(MemeRepositoryInterface::class, MemeApiRepository::class);
    }
}
