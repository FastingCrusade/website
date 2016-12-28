<?php

use App\Models\Gender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
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
Route::patch('/user/{user}', 'User@update');

// Gender Routes
Route::patch('/gender/{gender}/replace', 'GenderSwap')->middleware('auth');
Route::delete('/gender/{gender}', 'Gender@delete')->middleware('auth');
Route::post('/genders', 'Gender@create')->middleware('auth');

// Subscription Routes
Route::post('/newsletters/subscription', 'Newsletters@create');


