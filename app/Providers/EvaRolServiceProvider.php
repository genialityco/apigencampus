<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\evaLib\Services\EvaRol;

class EvaRolServiceProvider extends ServiceProvider
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
        $this->app->bind('App\evaLib\Services\EvaRol', function ($app) {
            return new EvaRol();
          });
    }
}
