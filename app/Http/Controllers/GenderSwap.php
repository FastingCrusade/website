<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 10-Dec-16
 * Time: 23:43
 */

namespace App\Http\Controllers;


use App\Models\Gender;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class GenderSwap extends Controller
{
    public function __invoke(Request $request, Gender $gender)
    {
        $status = 'OK';
        $code = Response::HTTP_OK;
        $message = '';
        /** @var Gender $replacement */
        $replacement = null;

        if (Auth::user()->is_admin) {
            try {
                $replacement = Gender::findOrFail($request->input('with'));
            } catch (ModelNotFoundException $exception) {
                $status = 'FAILED';
                $message = 'Invalid replacement provided.';
                $code = Response::HTTP_NOT_ACCEPTABLE;
            }

            if ($code === Response::HTTP_OK) {
                User::whereHas('gender', function (Builder $query) use ($gender) {
                    $query->where('id', $gender->id);
                })
                    ->get()
                    ->each(function (User $user) use ($replacement) {
                        $user->gender()->associate($replacement);
                        $user->save();
                    });

                $message = "Replaced {$gender->id} with {$replacement->id}.";
            }
        } else {
            $status = 'FAILED';
            $message = 'Not Authorized';
            $code = Response::HTTP_UNAUTHORIZED;
        }

        return response()->json([
            'status'  => $status,
            'message' => $message,
        ], $code);
    }
}
