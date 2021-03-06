<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-02
 * Time: 13:25
 */

namespace Testing;


use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends TestCase
{
    use DatabaseTransactions;

    public function testLoginAlreadyLoggedIn()
    {
        /** @var User $user */
        $user = factory('App\Models\User')->create();
        Auth::login($user);
        Session::start();

        $this->post('/login', [
            '_token' => csrf_token(),
        ]);

        $this->assertResponseOK();
        $this->seeJson();
    }
}
