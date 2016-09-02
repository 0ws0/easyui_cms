<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
Route::group(['prefix' => 'admin', 'middleware' => 'authority'], function() {
    Route::get('/', function () {
        return view('main');
    });
    Route::get('article', function() {
        // blablabla...
    });
});
*/

Route::group(['prefix' => '/'], function() {
    Route::get('main', function () {
        return view('main');
    });

    Route::get('login', function() {
        return view('login');
    });

    Route::get('sysuser', function() {
        return view('user');
    });

    //用户管理增删改查
    Route::post('add_user','UserController@addUsers');

    Route::post('del_user','UserController@delUsers');

    Route::post('modify_user','UserController@modifyUsers');

    Route::get('user','UserController@showUsers');

});

