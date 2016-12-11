<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 11-Dec-16
 * Time: 12:31
 */

namespace App\Http\Controllers;


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
        if (!Auth::user() || (!Auth::user()->is_admin) || Auth::user()->id !== $user->id) {
            $this->status = 'FAILED';
            $this->code = Response::HTTP_UNAUTHORIZED;
            $this->message = 'Not authorized.';
        } else {
            try {
                $gender = Gender::findOrFail($request->input('gender'));
            } catch (ModelNotFoundException $exception) {
                $this->status = 'FAILED';
                $this->code = Response::HTTP_NOT_ACCEPTABLE;
                $this->message = 'Invalid gender provided.';
                $gender = null;
            }

            if ($this->code !== Response::HTTP_NOT_ACCEPTABLE) {
                $user->first_name = $request->input('first_name');
                $user->last_name = $request->input('last_name');
                $user->gender()->associate($gender);
                $user->save();

                $this->message = "Updated {$user->id}.";
            }
        }

        return $this->response();
    }
}
