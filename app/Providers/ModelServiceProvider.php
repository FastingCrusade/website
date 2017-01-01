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

/**
 * Class ModelServiceProvider
 *
 * @package App\Providers
 */
class ModelServiceProvider extends ServiceProvider
{
    /**
     * Bootstraps Model Services.
     */
    public function boot()
    {
        User::observe('App\Models\Observers\UserObserver');
    }
}
