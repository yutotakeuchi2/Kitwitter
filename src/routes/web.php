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
Route::post('/tweet/store', 'TweetController@store');
//Route::get('/home', 'HomeController@home')->name('home');
//Route::get('/tweet/add', 'TweetController@add');
Route::get('/index','TweetController@index');

//Route::get('/index','TweetGetController@index');
Route::get('/destroy/{id}', 'TweetController@destroy');

Route::group(['middleware' => 'auth:user'], function()
{
    Route::get('users/index', 'UsersController@index');
    Route::get('users/edit', 'UsersController@edit');
    Route::post('users/edit', 'UsersController@update');
});


