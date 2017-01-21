<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-19
 * Time: 21:49
 */

namespace Testing;


use App\Models\Fast;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;

class FastCommentsController extends TestCase
{
    use DatabaseTransactions;

    public function testRoutes()
    {
        /** @var Fast $fast */
        $fast = factory('App\Models\Fast')->create();
        /** @var User $user */
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

    public function testListFastComments()
    {
        /** @var Fast $fast */
        $fast = factory('App\Models\Fast')->create();
        /** @var Collection $comments */
        $comments = factory('App\Models\Comment', 5)->create([
            'commentable_type' => 'App\Models\Fast',
            'commentable_id'   => $fast->id,
        ]);

        $this->get("/api/fast/{$fast->id}/comments");
        $this->assertResponseOk();
        $this->seeJson($comments->toArray());
    }
}
