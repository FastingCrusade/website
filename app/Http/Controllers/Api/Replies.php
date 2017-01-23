<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-22
 * Time: 23:09
 */

namespace App\Http\Controllers\Api;


use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Class Replies
 *
 * @package App\Http\Controllers\Api
 */
class Replies extends ApiController
{
    /**
     * Lists replies to a Comment.
     *
     * @param Comment $comment
     */
    public function index(Comment $comment)
    {
        $this->response($comment->comments);
    }

    /**
     * Adds a reply to a Comment.
     *
     * @param Request $request
     * @param Comment $comment
     *
     * @return Response
     */
    public function create(Request $request, Comment $comment)
    {
        /** @var Comment $reply */
        $reply = Comment::create([
            'contents' => $request->input('contents'),
            'user_id'  => Auth::user()->id,
        ]);
        $reply->parent()->associate($comment);

        return $this->response($reply->id, 'CREATED', Response::HTTP_CREATED);
    }
}
