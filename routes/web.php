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
  Route::get('/frontend/profile','frontend\ProfileController@index')->name('frontendEditProfile');
  Route::get('/frontend/friends','frontend\FindUserController@friendsView')->name('friendsView');
  Route::get('/frontend/friend/find','frontend\FindUserController@index')->name('frontendFindUser');
  Route::post('/frontend/friend/find/action','frontend\FindUserController@action')->name('frontendFindUserAction');
  Route::post('/frontend/profile/edit','frontend\ProfileController@action');

  Route::get('/frontend/work/add','frontend\WorkController@addWork')->name('addWork');
  Route::get('/frontend/file','frontend\FileController@index');
  Route::post('/frontend/file/add','frontend\FileController@add');
}

);
Route::get('/frontend/index','frontend\LoginController@index');
Route::post('/frontend/login','frontend\LoginController@login');
Route::post('/frontend/signup','frontend\RegisterController@createUser');

Route::get('/frontend/logout','frontend\LoginController@logout');
