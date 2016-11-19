<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('/Auth/login');
});




Route::group(['prefix' => '/home'], function () {
  Route::get('/', 'HomeController@index');

  Route::get('/section/add', 'SectionController@index');
  Route::post('/section/action', 'SectionController@action');
  Route::get('/section/list', 'SectionController@sectionList');

  Route::get('/category/add', 'CategoryController@index');
  Route::post('/category/create', 'CategoryController@create');
  Route::post('/category/action', 'CategoryController@action');

  Route::get('/content/add','contentController@index');
});
Route::post('/login','LoginController@login');

Route::group(['middleware' => 'checkuser'], function(){

  Route::get('/backend/user/list','backend\UserController@index');
  Route::post('/backend/user/action','backend\UserController@action');

  Route::get('/frontend/home','frontend\HomeController@home')->name('frontendHome');
  Route::get('/frontend/newsfeed','frontend\NewsfeedController@index')->name('newsfeedIndex');
  Route::get('/frontend/newsfeed/work/{workid}','frontend\NewsfeedController@showWork')->name('newsfeedWork');
  Route::post('/frontend/newsfeed/action','frontend\NewsfeedController@action')->name('newsfeedAction');

  Route::get('/frontend/friends','frontend\FindUserController@friendsView')->name('friendsView');
  Route::get('/frontend/friend/find','frontend\FindUserController@index')->name('frontendFindUser');
  Route::post('/frontend/friend/find/action','frontend\FindUserController@action')->name('frontendFindUserAction');

  Route::get('/frontend/profile','frontend\ProfileController@index')->name('frontendEditProfile');
  Route::post('/frontend/profile/edit','frontend\ProfileController@action');
  Route::post('/frontend/profile/cover','frontend\ProfileController@cover');

  Route::get('/frontend/work/add','frontend\WorkController@addWork')->name('addWork');
  Route::get('/frontend/work/edit/{workid}','frontend\WorkController@editWork')->name('editWork');
  Route::get('/frontend/work/list','frontend\WorkController@listWork')->name('listWork');
  Route::post('/frontend/work/action','frontend\WorkController@action')->name('workAction');

  Route::get('/frontend/file','frontend\FileController@index');
  Route::post('/frontend/file/add','frontend\FileController@add');

  Route::post('/frontend/home/post','frontend\HomeController@post');
  Route::post('/frontend/home/action','frontend\HomeController@action');

  Route::get('/frontend/home/test','frontend\HomeController@test');
  Route::post('/like','frontend\HomeController@postLikePost');
}

);
Route::get('/frontend/index','frontend\LoginController@index');
Route::post('/frontend/login','frontend\LoginController@login');
Route::post('/frontend/signup','frontend\RegisterController@createUser');

Route::get('/frontend/logout','frontend\LoginController@logout');
