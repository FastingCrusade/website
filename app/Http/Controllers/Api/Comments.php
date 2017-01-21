<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-21
 * Time: 00:03
 */

namespace App\Http\Controllers\Api;


use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Class Comments
 *
 * @package App\Http\Controllers\Api
 */
class Comments extends ApiController
{
    /**
     * Handles deleting a Comment.
     *
     * @param Comment $comment
     *
     * @return Response
     */
    public function delete(Comment $comment)
    {
        /** @var Response $response */
        $response = null;

        if (Auth::user()->is_admin || $comment->user->id === Auth::user()->id) {
            $comment->delete();
            $response = $this->response($comment->id);
        } else {
            $response = $this->notAuthorizedResponse();
        }

        return $response;
    }

    /**
     * Handles updating a Comment.
     *
     * @param Request $request
     * @param Comment $comment
     *
     * @return Response
     */
    public function update(Request $request, Comment $comment)
    {
        if (Auth::user()->id === $comment->user->id) {
            $comment->contents = $request->input('contents');
            $comment->save();
            $response = $this->response($comment->id, 'UPDATED', Response::HTTP_ACCEPTED);
        } else {
            $response = $this->notAuthorizedResponse();
        }

        return $response;
    }
}
