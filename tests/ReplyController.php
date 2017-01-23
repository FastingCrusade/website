<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-21
 * Time: 00:49
 */

namespace Testing;


use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

class ReplyController extends TestCase
{
    use DatabaseTransactions;

    public function testReplyToComment()
    {
        /** @var User $user */
        $user = factory('App\Models\User')->create();
        /** @var Comment $comment */
        $comment = factory('App\Models\Comment')->create();

        $this->post(
            "/api/comment/{$comment->id}/replies",
            [
                'contents' => 'This is a test reply.',
            ],
            [
                'Authorization' => "Bearer {$user->api_token}",
            ]
        );

        $this->assertResponseStatus(Response::HTTP_CREATED);
    }

    public function testListRepliesForComment()
    {
        /** @var Comment $comment */
        $comment = factory('App\Models\Comment')->create();
        $comments = factory('App\Models\Comment', 5)->create([
            'commentable_type' => 'App\Models\Comment',
            'commentable_id'   => $comment->id,
        ]);

        $this->get("/api/comment/{$comment->id}/replies");
        $this->assertResponseOk();
        $this->assertEquals($comments->pluck('id'), collect(json_decode($this->response->getContent())->data)->pluck('id'));
    }
}
