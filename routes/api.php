<?php

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

// User Routes
Route::get('/users', 'Users@index');
Route::get('/user/{user}', 'User@index');

// Fasts Routes
Route::get('/fasts', 'Fasts@index');

// Authenticated routes.
Route::group(['middleware' => 'auth:api'], function () {
    // User routes
    Route::patch('/user/{user}', 'User@update');

    // Gender Routes
    Route::patch('/gender/{gender}/replace', 'GenderSwap');
    Route::delete('/gender/{gender}', 'Gender@delete');
    Route::post('/genders', 'Gender@create');

    // Subscription Routes
    Route::post('/newsletters/subscription', 'Newsletters@create');

    // Fasts Routes
    Route::post('/fasts', 'Fasts@create');
});

