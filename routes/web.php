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
    return redirect('/start');
});

Route::get('/backend/login',function(){
  return view('/Auth/login');
});

Route::post('/backend/login','backend\LoginController@login');

Route::group(['middleware' => 'checkadmin'], function(){

    Route::get('/backend/home', 'backend\HomeController@index');

    Route::get('/backend/section/add', 'backend\SectionController@index');
    Route::post('/backend/section/action', 'backend\SectionController@action')->name('sectionAction');
    Route::get('/backend/section/list', 'backend\SectionController@sectionList');

    Route::get('/backend/category/add', 'backend\CategoryController@index');
    Route::post('/backend/category/create', 'backend\CategoryController@create');
    Route::post('/backend/category/action', 'backend\CategoryController@action');

    Route::get('/backend/pages/help', 'backend\PagesController@help')->name('adminViewHelp');
    Route::get('/backend/pages/help/list', 'backend\PagesController@helpList')->name('adminHelpList');
    Route::get('/backend/pages/help/{helpid}','backend\PagesController@editHelp')->name('editHelp');
    Route::post('/backend/pages/action', 'backend\PagesController@action')->name('adminActionPages');

    Route::get('/backend/content/add','backend\contentController@index');
    Route::get('/backend/logout','backend\LoginController@logout');


});
Route::group(['middleware' => 'checkuser'], function(){

  Route::get('/backend/user/list','backend\UserController@index');
  Route::post('/backend/user/action','backend\UserController@action');

  Route::get('/backend/order','backend\OrderController@orders')->name('workOrders');
  Route::get('/backend/order/view/{orderid}','backend\OrderController@viewOrder')->name('viewOrder');
  Route::post('/backend/order/action','backend\OrderController@action')->name('actionOrder');

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
  Route::get('/frontend/work/txn','frontend\WorkController@txnWork')->name('txnWork');
  Route::post('/frontend/work/action','frontend\WorkController@action')->name('workAction');

  Route::get('/frontend/groups/{groupid}','frontend\GroupController@viewGroup')->name('viewGroup');
  Route::post('/frontend/group/action','frontend\GroupController@action')->name('groupAction');
  Route::post('/frontend/group/post','frontend\GroupController@post')->name('groupPost');
  Route::post('/frontend/group/like','frontend\GroupController@like');

  Route::get('/frontend/file','frontend\FileController@index');
  Route::post('/frontend/file/add','frontend\FileController@add');

  Route::post('/frontend/home/post','frontend\HomeController@post');
  Route::post('/frontend/home/action','frontend\HomeController@action');

  Route::get('/frontend/home/test','frontend\HomeController@test');
  Route::post('/like','frontend\HomeController@postLikePost');
  Route::get('/frontend/home/photos','frontend\PhotosController@action')->name('photos');


  Route::get('/frontend/userprofile','frontend\ProfileController@userprofile')->name('userProfile');
  Route::get('/frontend/userabout','frontend\ProfileController@userabout')->name('userAbout');
  Route::get('/frontend/userFriendsList','frontend\ProfileController@userFriendsList')->name('userFriendsList');
  Route::get('/frontend/userPhotos','frontend\PhotosController@userPhotos')->name('userPhotos');

  Route::post('/frontend/comment/action','frontend\CommentController@action')->name('commentAction');
  Route::post('/frontend/salary/action','frontend\SalaryController@action')->name('salaryAction');
}

);

Route::get('frontend/facebook', 'frontend\LoginController@redirectToProvider');
Route::get('frontend/facebook/callback', 'frontend\LoginController@handleProviderCallback');
Route::get('/frontend/index','frontend\LoginController@index');
Route::post('/frontend/login','frontend\LoginController@login');
Route::post('/frontend/signup','frontend\RegisterController@createUser');

Route::get('/start','start\StartController@index');
Route::get('/start/category','start\StartController@startCatView')->name('startCatView');
Route::get('/frontend/pages/help', 'frontend\PagesController@help')->name('viewHelp');
Route::get('/frontend/pages/about', 'frontend\PagesController@about')->name('viewAbout');
Route::get('/frontend/pages/member', 'frontend\PagesController@member')->name('viewMember');

Route::get('/frontend/logout','frontend\LoginController@logout');
