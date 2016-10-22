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



Auth::routes();
Route::group(['prefix' => '/home'], function () {
  Route::get('/', 'HomeController@index');

  Route::get('/section/add', 'SectionController@index');
  Route::post('/section/action', 'SectionController@action');
  Route::get('/section/list', 'SectionController@sectionList');

  Route::get('/category/add', 'CategoryController@index');
  Route::post('/category/create', 'CategoryController@create');
});
Auth::routes();
