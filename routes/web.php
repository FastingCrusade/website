<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    /** @var User $user */
    $user = Auth::user();
    $name = $user->fullName() ?: $user->email;

    return view('home', [
        'user'  => $name,
        'admin' => $user->is_admin,
    ]);
});

Auth::routes();

Route::post('/deploy', 'Server@deploy');
