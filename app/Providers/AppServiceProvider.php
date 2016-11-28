<?php

namespace App\Providers;

use App\ImageHandlers\Gravatar;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Contracts\ImageHandler', function ($app) {
            return $app->make('App\ImageHandlers\Gravatar');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
