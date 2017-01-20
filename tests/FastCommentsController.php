<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-19
 * Time: 21:49
 */

namespace Testing;


use App\Models\Fast;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FastCommentsController extends TestCase
{
    use DatabaseTransactions;

    public function testRoutes()
    {
        /** @var Fast $fast */
        $fast = factory('App\Models\Fast')->create();
        $user = factory('App\Models\User')->create();

        $this->get("/api/fast/{$fast->id}/comments");
        $this->assertResponseOk();

        $this->post(
            "/api/fast/{$fast->id}/comments",
            ['contents' => 'Test Comment'],
            [
                'Authorization' => "Bearer {$user->api_token}",
            ]
        );
        $this->assertResponseOk();
    }
}
