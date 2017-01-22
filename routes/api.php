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
Route::get('/user/{user}/fasts', 'UserFasts@index');

// Fasts Routes
Route::get('/fasts', 'Fasts@index');
Route::get('/fast/{fast}/comments', 'FastComments@index');

// Subscription Routes
Route::post('/newsletters/subscription', 'Newsletters@create');

// Authenticated routes.
Route::group(['middleware' => 'auth:api'], function () {
    // User routes
    Route::patch('/user/{user}', 'User@update');

    // Gender Routes
    Route::patch('/gender/{gender}/replace', 'GenderSwap');
    Route::delete('/gender/{gender}', 'Gender@delete');
    Route::post('/genders', 'Gender@create');

    // Fasts Routes
    Route::post('/fasts', 'Fasts@create');
    Route::post('/fast/{fast}/comments', 'FastComments@create');

    // Comment Routes
    Route::delete('/comments/{comment}', 'Comments@delete');
    Route::post('/comments/{comment}', 'Comments@update');
});
