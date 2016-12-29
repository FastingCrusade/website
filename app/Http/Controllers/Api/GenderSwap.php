<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 10-Dec-16
 * Time: 23:43
 */

namespace App\Http\Controllers\Api;


use App\Models\Gender;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Class GenderSwap
 *
 * @package App\Http\Controllers
 */
class GenderSwap extends ApiController
{
    /**
     * Removes one Gender and replaces it for all Users.
     *
     * @param Request $request
     * @param Gender  $gender
     *
     * @return Response
     */
    public function __invoke(Request $request, Gender $gender)
    {
        /** @var Gender $replacement */
        $replacement = null;

        if (Auth::user() && Auth::user()->is_admin) {
            try {
                $replacement = Gender::findOrFail($request->input('with'));
            } catch (ModelNotFoundException $exception) {
                $this->status = 'FAILED';
                $this->data = 'Invalid replacement provided.';
                $this->code = Response::HTTP_NOT_ACCEPTABLE;
            }

            if ($this->code === Response::HTTP_OK) {
                User::whereHas('gender', function (Builder $query) use ($gender) {
                    $query->where('id', $gender->id);
                })
                    ->get()
                    ->each(function (User $user) use ($replacement) {
                        $user->gender()->associate($replacement);
                        $user->save();
                    });
                $gender->delete();

                $this->data = "Replaced {$gender->id} with {$replacement->id}.";
            }
        } else {
            $this->status = 'FAILED';
            $this->data = 'Not Authorized';
            $this->code = Response::HTTP_UNAUTHORIZED;
        }

        return $this->response();
    }
}
