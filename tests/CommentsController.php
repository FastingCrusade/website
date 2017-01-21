<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-21
 * Time: 00:08
 */

namespace Testing;


use App\Models\Comment;
use App\Models\User as UserModel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

class CommentsController extends TestCase
{
    use DatabaseTransactions;

    public function testDelete()
    {
        /** @var Comment $comment */
        $comment = factory('App\Models\Comment')->create();
        /** @var UserModel $user */
        $user = factory('App\Models\User')->create();

        $this->delete("/api/comments/{$comment->id}", [], ['Authorization' => "Bearer {$user->api_token}"]);
        $this->assertResponseOk();

        $comment = $comment->fresh();
        $this->assertTrue($comment->trashed());
    }

    public function testUpdate()
    {
        /** @var Comment $comment */
        $comment = factory('App\Models\Comment')->create();
        /** @var UserModel $user */
        $user = factory('App\Models\User')->create();

        $this->post(
            "/api/comments/{$comment->id}",
            [
                'contents' => 'This is an edited comment.',
            ],
            [
                'Authorization' => "Bearer {$user->api_token}",
            ]
        );
        $this->assertResponseOk();

        $comment = $comment->fresh();
        $this->assertEquals('This is an edited comment.', $comment->contents);
    }
}
