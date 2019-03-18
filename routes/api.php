<?php

use Illuminate\Http\Request;

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
// move checking ip to nginx or apache?
Route::group(['middleware' => ['ip']], function() {
    Route::post('login', 'API\UserController@login');
    Route::post('register', 'API\UserController@register');

    Route::group(['middleware' => ['auth:api']], function(){

        //e.g.
        // Closest period: api/streams/1,2,3,5
        // Specific period: api/streams/1,2,3,5?period=date
        Route::get('/streams/{game_ids}', 'API\StreamController@getStreams')
            ->where('game_ids', '[0-9,]+');

        // Closest period: api/streams/viewers/1,2,3,5
        // Specific period: api/streams/viewers/1,2,3,5?period=date
        Route::get('/streams/viewers/{game_ids}', 'API\StreamController@getViewers')
            ->where('game_ids', '[0-9,]+');
    });

});
