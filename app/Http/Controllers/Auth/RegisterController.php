<?php

namespace App\Http\Controllers\Auth;

use App\Misc\SquareClient;
use App\Models\SquareCreditCard;
use App\Models\Subscription;
use App\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SquareConnect\Model\Card;
use SquareConnect\Model\Customer;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function registered(Request $request, User $user)
    {
        $cost = config('prices.base_subscription');
        /** @var SquareClient $client */
        $client = App::make('App\Misc\SquareClient');
        /** @var Customer $customer */
//        $customer = $client->createCustomer($user);
        /** @var Card $card */
//        $card = $client->createCard($request->input('nonce'), $customer);
//        $full_card = SquareCreditCard::create([
//            'customer_id' => $customer->getId(),
//            'card_id'     => $card->getId(),
//        ]);

        if ($request->input('discount_code', false)) {
            // TODO handle with a multiplier.
        }

//        $charged = $client->charge($full_card, $request->input('cost', $cost));

//        if ($charged) {
//            /** @var Subscription $subscription */
//            $subscription = Subscription::create([
//                'expires_at'          => Carbon::now()->addMonth(),
//                'fee'                 => $cost,
//                'user_id'             => $user->id,
//                'payment_method_id'   => $full_card->id,
//                'payment_method_type' => SquareCreditCard::class,
//            ]);
//            $full_card->subscriptions()->save($subscription);
//            $user->subscription()->save($subscription);
//        }

        return response()->json([
//            'success' => $charged ? 'OK' : 'FAILURE',
            'success' => 'OK',
            'data'    => [
//                'transaction_id' => $charged ?: null,
                'user'           => Auth::user(),
            ],
//        ], $charged ? Response::HTTP_ACCEPTED : Response::HTTP_I_AM_A_TEAPOT);
        ], Response::HTTP_ACCEPTED);
    }
}
