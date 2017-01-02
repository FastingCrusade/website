<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-01
 * Time: 03:36
 */

namespace App\Http\Controllers\Api;


use App\Models\Fast;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Fasts extends ApiController
{
    public function index()
    {
        $pagination = Fast::paginate(config('app.results_per_page'));

        return $this->response($pagination);
    }

    public function create(Request $request)
    {
        /** @var Fast $fast */
        $fast = Fast::create($request->all());

        if ($fast) {
            $response = $this->response($fast->id, 'OK', Response::HTTP_CREATED);
        } else {
            $response = $this->response('Failed to create a Fast.', 'FAILED', Response::HTTP_NOT_ACCEPTABLE);
        }

        return $response;
    }
}
