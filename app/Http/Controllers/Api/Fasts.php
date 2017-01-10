<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-01
 * Time: 03:36
 */

namespace App\Http\Controllers\Api;


use App\Models\Fast;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

/**
 * Class Fasts
 *
 * @package App\Http\Controllers\Api
 */
class Fasts extends ApiController
{
    /**
     * Provides list of all Fasts.
     *
     * @return Response
     */
    public function index()
    {
        $pagination = Fast::paginate(config('app.results_per_page'));

        return $this->response($pagination);
    }

    /**
     * Creates a Fast with given attributes.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->id === $request->input('user_id') || $user->is_admin) {
            /** @var Fast $fast */
            $fast = App::make('App\Models\Fast');
            $fast->fill($request->only($fast->getFillable()));

            if ($fast->save()) {
                $response = $this->response($fast->id, 'OK', Response::HTTP_CREATED);
            } else {
                $response = $this->response('Failed to create a Fast.', 'FAILED', Response::HTTP_NOT_ACCEPTABLE);
            }
        } else {
            $response = $this->response('Not authorized for this action.', 'REJECTED', Response::HTTP_UNAUTHORIZED);
        }

        return $response;
    }
}
