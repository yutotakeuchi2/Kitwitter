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
Route::get('/home', 'HomeController@home')->name('home');
Route::get('/tweet/add', 'TweetController@add');
Route::get('/index','HomeController@index');

Route::get('/index','HomeController@index');

ROute::get('/index','TweetGetController@tweetGet');
