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

class CommentsController extends TestCase
{
    use DatabaseTransactions;

    public function testDelete()
    {
        /** @var UserModel $user */
        $user = factory('App\Models\User')->create();
        /** @var Comment $comment */
        $comment = factory('App\Models\Comment')->create([
            'user_id' => $user->id,
        ]);

        $this->delete("/api/comments/{$comment->id}", [], ['Authorization' => "Bearer {$user->api_token}"]);
        $this->assertResponseOk();

        $comment = $comment->fresh();
        $this->assertTrue($comment->trashed());
    }

    public function testUpdate()
    {
        /** @var UserModel $user */
        $user = factory('App\Models\User')->create();
        /** @var Comment $comment */
        $comment = factory('App\Models\Comment')->create([
            'user_id' => $user->id,
        ]);

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

    public function testDeleteAsAdmin()
    {
        /** @var UserModel $admin */
        $admin = factory('App\Models\User')->states(['admin'])->create();
        /** @var UserModel $user */
        $user = factory('App\Models\User')->create();
        /** @var Comment $comment */
        $comment = factory('App\Models\Comment')->create([
            'user_id' => $user->id,
        ]);

        $this->delete("/api/comments/{$comment->id}", [], ['Authorization' => "Bearer {$admin->api_token}"]);
        $this->assertResponseOk();

        $comment = $comment->fresh();
        $this->assertTrue($comment->trashed());
    }
}
