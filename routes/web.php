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
  Route::get('/category/add', 'CategoryController@index');
});
Auth::routes();
