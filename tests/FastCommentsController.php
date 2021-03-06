<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-19
 * Time: 21:49
 */

namespace Testing;


use App\Models\Comment;
use App\Models\Fast;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
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
        $this->assertResponseStatus(Response::HTTP_CREATED);
    }

    public function testListFastComments()
    {
        /** @var Fast $fast */
        $fast = factory('App\Models\Fast')->create();
        /** @var Collection $comments */
        $comments = factory('App\Models\Comment', 5)->create([
            'commentable_type' => 'App\Models\Fast',
            'commentable_id'   => $fast->id,
        ])
            ->each(function (Comment $comment) {
                $comment->comments()->create([
                    'commentable_type' => 'App\Models\Comment',
                    'commentable_id'   => $comment->id,
                    'user_id'          => factory('App\Models\User')->create()->id,
                    'contents'         => 'Test reply.',
                ]);
            });

        $this->get("/api/fast/{$fast->id}/comments");
        $this->assertResponseOk();

        $this->assertEquals($comments->pluck('id'), collect(json_decode($this->response->getContent())->data)->pluck('id'));
        collect(json_decode($this->response->getContent())->data)->each(function ($comment) {
            $this->assertEquals(1, $comment->replies);
        });
    }

    public function testAddCommentToFast()
    {
        /** @var User $user */
        $user = factory('App\Models\User')->create();
        /** @var Fast $fast */
        $fast = factory('App\Models\Fast')->create([
            'user_id' => $user->id,
        ]);

        $this->post(
            "/api/fast/{$fast->id}/comments",
            [
                'contents' => 'This is a test comment.',
            ],
            [
                'Authorization' => "Bearer {$user->api_token}",
            ]
        );
        $fast->load('comments');

        $this->assertResponseStatus(Response::HTTP_CREATED);

        /** @var Comment $comment */
        $comment = Comment::find(json_decode($this->response->getContent())->data);

        $this->assertEquals($fast->comments->first()->id, $comment->id);
        $this->assertEquals($fast->comments->first()->contents, $comment->contents);
        $this->assertEquals($user->id, $comment->user_id);
    }
}
