<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-01
 * Time: 03:36
 */

namespace App\Http\Controllers\Api;


use App\Models\Fast;

class Fasts extends ApiController
{
    public function index()
    {
        $pagination = Fast::paginate(config('app.results_per_page'));

        return $this->response($pagination);
    }
}
