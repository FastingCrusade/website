<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 27-Nov-16
 * Time: 21:55
 */

namespace App\Providers;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*', function ($view) {
            $user = Auth::user() ?: App::make('App\Models\User', [[]]);
            $view->with('current_user', $user);
        });
    }
}
