<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 11-Dec-16
 * Time: 01:23
 */

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Gender as GenderModel;

class Gender extends ApiController
{
    public function delete(GenderModel $gender)
    {
        if (Auth::user() && Auth::user()->is_admin) {
            $gender->delete();
            $response = $this->response("Deleted {$gender->id}.");
        } else {
            $response = $this->response('Not authorized.', 'FAILED', Response::HTTP_UNAUTHORIZED);
        }

        return $response;
    }

    public function create(Request $request)
    {
        /** @var GenderModel $gender */
        $gender = GenderModel::create($request->only(['name', 'icon']));
        if (preg_match('/icon$|^icon| icon /', $gender->icon) === 0) {
            $gender->icon .= ' icon';
            $gender->save();
        }

        return $this->response("Created {$gender->id}.");
    }
}
