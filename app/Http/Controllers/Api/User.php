<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 11-Dec-16
 * Time: 12:31
 */

namespace App\Http\Controllers\Api;


use App\Models\Gender;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class User extends ApiController
{
    public function update(Request $request, UserModel $user)
    {
        if ((!Auth::user() || Auth::user()->id !== $user->id) && !(Auth::user() && Auth::user()->is_admin)) {
            $this->status = 'FAILED';
            $this->code = Response::HTTP_UNAUTHORIZED;
            $this->message = 'Not authorized.';
        } else {
            $user->first_name = $request->input('first_name') ?: $user->first_name;
            $user->last_name = $request->input('last_name') ?: $user->last_name;
            $user->is_admin = $request->input('admin_toggle') ?: $user->is_admin;

            if ($request->input('gender')) {
                try {
                    $gender = Gender::findOrFail($request->input('gender'));
                    $user->gender()->associate($gender);
                    $user->save();
                    $this->message = "Updated {$user->id}.";
                } catch (ModelNotFoundException $exception) {
                    $this->status = 'FAILED';
                    $this->code = Response::HTTP_NOT_ACCEPTABLE;
                    $this->message = 'Invalid gender provided.';
                    $gender = null;
                }
            } else {
                $user->save();
                $this->message = "Updated {$user->id}.";
            }
        }

        return $this->response();
    }
}
