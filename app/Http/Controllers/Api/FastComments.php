<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-19
 * Time: 21:48
 */

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Models\Fast;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


/**
 * Class FastComments
 * Controller for managing the Comments on a Fast.
 *
 * @package App\Http\Controllers\Api
 */
class FastComments extends ApiController
{
    /**
     * Lists the Comments for the given Fast.
     *
     * @param Fast $fast
     *
     * @return Response
     */
    public function index(Fast $fast)
    {
        return $this->response($fast->comments);
    }

    /**
     * Adds a Comment to a Fast.
     *
     * @param Request $request
     * @param Fast    $fast
     *
     * @return Response
     */
    public function create(Request $request, Fast $fast)
    {
        /** @var Comment $comment */
        $comment = $fast->comments()->create([
            'user_id'  => Auth::user()->id,
            'contents' => $request->input('contents'),
        ]);

        return $this->response($comment->id, 'CREATED', Response::HTTP_CREATED);
    }
}
