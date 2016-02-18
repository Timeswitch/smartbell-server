<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['prefix' => 'api'], function () {
    Route::group(['prefix' => 'v1'],function(){

        Route::controller('auth','AuthenticationController');
        Route::post('ring/{uuid}','BellController@createRing');

        Route::group(['middleware' => ['jwt.auth','jwt.refresh']], function (){

            Route::get('rings/','RingController@index');
            Route::get('rings/{id}','RingController@show');
            Route::delete('rings/{id}','RingController@show');

            Route::get('bells/','BellController@index');
            Route::post('bells/','BellController@getIndex');
            Route::get('bells/{id}','BellController@show');
            Route::post('bells/{id}','BellController@update');
            Route::delete('bells/{id}','BellController@destroy');
        });


    });
});
