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


Route::get('home',[
    'uses' => 'AppController@home',
    'as' => 'home',
    //'middleware' => ['session.expired']
]);

Route::get('users/{id}',[
    'uses' => 'UserController@details',
    'as' => 'user.details',
]);

Route::get('users/edit/{id}',[
    'uses' => 'UserController@edit',
    'as' => 'user.edit',
]);


Route::post('users/add',[
    'uses' => 'UserController@add',
    'as' => 'user.add',
]);


// Registration routes...
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');