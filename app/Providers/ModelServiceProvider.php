<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 30-Dec-16
 * Time: 22:25
 */

namespace App\Providers;


use App\Models\User;
use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        User::observe('App\Models\Observers\UserObserver');
    }
}
