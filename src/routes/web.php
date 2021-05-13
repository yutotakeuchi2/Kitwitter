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
    return view('welcome');//ルートがindexで、ログインされてななければwelcomeに飛ばす形でもいい？
});

Auth::routes();
//Route::get('/home', 'HomeController@home')->name('home');
Route::get('tweet/index','TweetController@index');
Route::post('/tweet/store', 'TweetController@store');
Route::get('/destroy/{id}', 'TweetController@destroy');
Route::get('tweet/show/{id}','TweetController@show');

//Route::group(['prefix' => 'users'], function()
//{
    Route::get('users/index', 'UsersController@index');
    Route::get('users/edit', 'UsersController@edit')->name('users.edit');
    Route::post('users/edit', 'UsersController@update');
    Route::get('users/show/{id}','UsersController@show');
//});
    Route::get('search/index','SearchController@index')->name('index');
    //Route::get('api/search', 'Api/SearchController@read');　<<これではなくAPIとして実装する場合は別途API.php
Route::view('/test', "test");
