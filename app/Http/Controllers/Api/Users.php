<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 28-Dec-16
 * Time: 01:02
 */

namespace App\Http\Controllers\Api;


use App\Models\User;

class Users extends ApiController
{
    public function index()
    {
        return $this->response(User::all());
    }
}
