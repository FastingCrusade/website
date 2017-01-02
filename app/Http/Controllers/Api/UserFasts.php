<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-02
 * Time: 01:36
 */

namespace App\Http\Controllers\Api;


use App\Models\User as UserModel;

/**
 * Class UserFasts
 *
 * @package App\Http\Controllers\Api
 */
class UserFasts extends ApiController
{
    public function index(UserModel $user)
    {
        $pagination = $user->fasts()->paginate(config('app.results_per_page'));

        return $this->response($pagination);
    }
}
