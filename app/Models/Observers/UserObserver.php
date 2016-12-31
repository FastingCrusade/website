<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 30-Dec-16
 * Time: 22:23
 */

namespace App\Models\Observers;


use App\Models\User;

/**
 * Class UserObserver
 *
 * Provides observation methods for the User class.
 *
 * @package App\Models\Observers
 */
class UserObserver
{
    /**
     * Observes the User::creating() event.
     *
     * @param User $user
     *
     * @return bool
     */
    public function creating(User $user)
    {
        $user->api_token = md5($user->email . config('app.token_salt'));

        return true;
    }
}
