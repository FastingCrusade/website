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
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends TestCase
{
    use DatabaseTransactions;

    public function testLoginAlreadyLoggedIn()
    {
        /** @var User $user */
        $user = factory('App\Models\User')->create();
        Auth::login($user);

        $this->post('/login', [

        ]);

        $this->assertResponseStatus(Response::HTTP_ACCEPTED);
        $this->seeJson();
    }
}
