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
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    /** @var User $user */
    $user = Auth::user();

    if ($user) {
        $name = $user->fullName() ?: $user->email;
    } else {
        $name = null;
    }

    return view('home', [
        'user'  => $name,
        'admin' => $user ? $user->is_admin : false,
    ]);
});

//Auth::routes();
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Utility routes
Route::post('/deploy', 'Server@deploy');
