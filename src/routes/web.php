<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@home')->name('home');

Route::get('/index','HomeController@index');

Route::get('/index','TweetGetController@tweetGet');

Route::group(['middleware' => 'auth:user'], function()
{
    Route::get('users/index', 'UserController@index');
    Route::get('users/edit', 'UserController@edit');
    Route::post('users/edit', 'UserController@update');
});

