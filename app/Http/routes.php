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

Route::get('/', [
    'uses' => 'Auth\AuthController@getLogin',
    'as' => 'login'
]);

Route::post('/', 'Auth\AuthController@postLogin');

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');



Route::get('logout', [
    'uses' => 'Auth\AuthController@getLogout',
    'as' => 'logout'
]);

Route::get('exit',[
    'uses' => 'AppController@logout',
    'as' => 'exit'
]);


Route::get('home',[
    'uses' => 'AppController@home',
    'as' => 'home',
    //'middleware' => ['session.expired']
]);

Route::get('users',[
    'uses' => 'UserController@users',
    'as' => 'users',
]);


Route::get('users/{id}',[
    'uses' => 'UserController@details',
    'as' => 'user.details',
]);

Route::get('users/edit',[
    'uses' => 'UserController@edit',
    'as' => 'user.edit',
]);

Route::post('users/add',[
    'uses' => 'UserController@add',
    'as' => 'user.add',
    'before' => 'csrf',
]);


Route::get('apps',[
    'uses' => 'AppController@apps',
    'as' => 'apps',
]);


Route::get('apps/{id}',[
    'uses' => 'AppController@details',
    'as' => 'apps.details',
]);

Route::post('apps/add',[
    'uses' => 'AppController@add',
    'as' => 'apps.add',
]);

Route::post('apps/edit',[
    'uses' => 'AppController@edit',
    'as' => 'apps.edit',
]);

//* Clientes *//
Route::get('clients/search/{id}',[
    'uses' => 'ClientController@search',
    'as' => 'clients.search',
]);

Route::post('clients/add',[
    'uses' => 'ClientController@add',
    'as' => 'clients.add',
]);

Route::get('clients/del/{client}/{app}',[
    'uses' => 'ClientController@del',
    'as' => 'clients.del',
]);


/** API OTP **/
Route::get('api/otp/get/{mail}',[
    'uses' => 'OtpController@getOTP',
    'as' => 'api.otp.get',
]);

Route::get('api/otp/verify/{code}/{ip}',[
    'uses' => 'OtpController@verifyOTP',
    'as' => 'api.otp.verify',
]);

Route::get('api/otp/session/{code}/{ip}',[
    'uses' => 'OtpController@verifySession',
    'as' => 'api.otp.session',
]);

Route::get('api/otp/close/{code}/{ip}',[
    'uses' => 'OtpController@closeOTP',
    'as' => 'api.otp.close',
]);