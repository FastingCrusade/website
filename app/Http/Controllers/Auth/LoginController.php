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

    /**
     * Handles login requests.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function login(Request $request)
    {
        if (Auth::check()) {
            $response = $this->sendLoginResponse($request, false);
        } else {
            $this->validateLogin($request);

            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                $response = $this->sendLockoutResponse($request);
            } else {
                if ($this->attemptLogin($request)) {
                    $response = $this->sendLoginResponse($request);
                } else {
                    // If the login attempt was unsuccessful we will increment the number of attempts
                    // to login and redirect the user back to the login form. Of course, when this
                    // user surpasses their maximum number of attempts they will get locked out.
                    $this->incrementLoginAttempts($request);

                    $response = $this->sendFailedLoginResponse();
                }
            }
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
     * @param bool    $clear_session
     *
     * @return Response
     */
    public function sendLoginResponse(Request $request, $clear_session = true)
    {
        if ($clear_session) {
            $request->session()->regenerate();
        }

        $this->clearLoginAttempts($request);

        return response()->json([
            'status' => 'OK',
            'data' => Auth::user(),
        ], Response::HTTP_OK);
    }
}
