<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function login(Request $request)
    {
        if (Auth::check()) {
            $response = response()->json([
                'status' => 'OK',
                'data' => 'Already logged in.',
            ], Response::HTTP_ACCEPTED);
        } else {
            $response = parent::login($request);
        }

        return $response;
    }

    /**
     * Returns the response expected for a failed login attempt.
     *
     * @return mixed
     */
    public function sendFailedLoginResponse()
    {
        return response()->json([
            'status' => 'REJECTED',
            'data' => [],
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Returns the response expected for a successful login attempt.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return response()->json([
            'status' => 'OK',
            'data' => Auth::user(),
        ], Response::HTTP_OK);
    }
}
