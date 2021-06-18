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

use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');//ルートがindexで、ログインされてななければwelcomeに飛ばす形でもいい？
});

Auth::routes();
//Route::get('/home', 'HomeController@home')->name('home');
Route::get('/tweet/index','TweetController@index');
Route::post('/tweet/store', 'TweetController@store')->middleware('auth');
Route::get('/destroy/{id}', 'TweetController@destroy')->middleware('auth');
Route::get('tweet/show/{id}','TweetController@show');

//Route::group(['prefix' => 'users'], function()
//{
    //Route::get('users/index', 'UsersController@index');
    Route::get('users/edit', 'UsersController@edit')->middleware('auth')->name('users.edit');
    Route::post('users/edit', 'UsersController@update');
    Route::get('users/show/{id}','UsersController@show');
    Route::delete('users/destroy/{id}','UsersController@destroy')->name('users.destroy');
    Route::view('users/destroy/confirm',"users/destroy")->middleware('auth');
    Route::post('users/restore/{id}', "UsersController@restore");
    Route::post('users/follow/{id}', "UsersController@follow")->middleware('auth');
    Route::post('users/unfollow/{id}', "UsersController@unFollow")->middleware('auth');
    Route::get('users/follower/{id}', "UsersController@follower");
    Route::get('users/follows/{id}', "usersController@follows");
//});
    Route::get('search/index','SearchController@index')->name('index');
    //Route::get('api/search', 'Api/SearchController@read');　<<これではなくAPIとして実装する場合は別途API.php

Route::post('api/favorite/store', 'Api\FavoriteController@store');

Route::view('/test', "test");
