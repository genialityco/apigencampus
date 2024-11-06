<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\evaLib\Services\GoogleFiles;

class EvaFilesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\evaLib\Services\GoogleFiles', function ($app) {
            return new GoogleFiles();
          });
    }
}
