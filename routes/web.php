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

use App\Models\Gender;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    /** @var User $user */
    return view('home');
});

Route::get('/users/{user}', function (App\Models\User $user) {
    $editable = (Auth::user() && Auth::user()->id === $user->id);
    $genders = Gender::all()->toJson();

    return view('user', [
        'user'      => $user,
        'editable'  => $editable,
        'genders'   => $genders,
    ]);
});

//Auth::routes();
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Utility routes
Route::post('/deploy', 'Server@deploy');
