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
    return view('home');
});
Route::get('/admin', function () {
    // TODO Should 404 to hide its existence.
    $response = redirect('/');

    if (Auth::user() && Auth::user()->is_admin) {
        $genders = Gender::all()->toJson();

        $response = view('admin', [
            'genders' => $genders,
        ]);
    }

    return $response;
});

// User Routes
Route::get('/user/{user}', function (User $user) {
    $editable = (Auth::user() && Auth::user()->id === $user->id);
    $genders = Gender::all()->toJson();

    return view('user', [
        'user'     => $user,
        'editable' => $editable,
        'genders'  => $genders,
    ]);
});
Route::patch('/user/{user}', function (User $user) {});

// Gender Routes
Route::patch('/gender/{gender}/replace', 'GenderSwap')->middleware('auth');
Route::delete('/gender/{gender}', 'Gender@delete')->middleware('auth');
Route::post('/genders', 'Gender@create')->middleware('auth');

//Auth::routes();
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Utility routes
Route::post('/deploy', 'Server@deploy');
