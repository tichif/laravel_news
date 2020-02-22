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

Route::get('/','HomePageController@index');
// Route::get('/listing','ListingPageController@index');
Route::get('/category/{id}','ListingPageController@index');
Route::get('/author/{id}','ListingPageController@author');
Route::get('/details/{slug}', 'DetailsPageController@index');
// Route::get('/details','DetailsPageController@index');
Route::post('/comments', 'DetailsPageController@comment');

//Admin
Route::group(['prefix'=>'back', 'middleware' => 'auth'], function(){
  Route::get('/','Admin\DashboardController@index');
  Route::get('/category','Admin\CategoryController@index');
  Route::get('/category/create','Admin\CategoryController@create');
  Route::get('/category/edit','Admin\CategoryController@edit');

  //Permissions
  Route::get('/permission', ['uses' => 'Admin\PermissionController@index', 'as' => 'permission-list', 'middleware'=> 'permission:Permission List|All']);
  Route::get('/permission/create',['uses' =>'Admin\PermissionController@create', 'as' => 'permission-create', 'middleware'=> 'permission:Permission Add|All'] );
  Route::post('/permission/store','Admin\PermissionController@store');
  Route::get('/permission/edit/{id}', ['uses' => 'Admin\PermissionController@edit', 'as' => 'permission-edit', 'middleware'=> 'permission:Permission Update|All']);
  Route::put('/permission/edit/{id}', ['uses' => 'Admin\PermissionController@update', 'as' => 'permission-update']);
  Route::delete('/permission/delete/{id}', ['uses' => 'Admin\PermissionController@destroy', 'as' => 'permission-delete', 'middleware'=>'permission:Permission Delete|All']);

  //Roles
  Route::get('/roles',['uses' => 'Admin\RoleController@index', 'as' => 'role-list', 'middleware'=> 'permission:Role List|All'] );
  Route::get('/roles/create',['uses' =>'Admin\RoleController@create', 'as' => 'role-create', 'middleware'=> 'permission:Role Add|All']);
  Route::post('/roles/store','Admin\RoleController@store');
  Route::get('/roles/edit/{id}', ['uses' => 'Admin\RoleController@edit', 'as' => 'role-edit', 'middleware'=> 'permission:Role Update|All']);
  Route::put('/roles/edit/{id}', ['uses' => 'Admin\RoleController@update', 'as' => 'role-update']);
  Route::delete('/roles/delete/{id}', ['uses' => 'Admin\RoleController@destroy', 'as' => 'role-delete', 'middleware'=> 'permission:Role Delete|All']);

  //Authors
  Route::get('/author',['uses' => 'Admin\AuthorController@index', 'as' => 'author-list', 'middleware'=> 'permission:	Author List|All']);
  Route::get('/author/create',['uses' =>'Admin\AuthorController@create', 'as' => 'author-create', 'middleware'=> 'permission:Author Add|All'] );
  Route::post('/author/store','Admin\AuthorController@store');
  Route::get('/author/edit/{id}', ['uses' => 'Admin\AuthorController@edit', 'as' => 'author-edit', 'middleware'=> 'permission:Author Update|All']);
  Route::put('/author/edit/{id}', ['uses' => 'Admin\AuthorController@update', 'as' => 'author-update']);
  Route::delete('/author/delete/{id}', ['uses' => 'Admin\AuthorController@destroy', 'as' => 'author-delete', 'middleware'=> 'Author Delete']);

  //Categories
  Route::get('/categories',['uses' => 'Admin\CategoryController@index', 'as' => 'category-list', 'middleware'=> 'permission:Category List|All']);
  Route::get('/permission/create',['uses' =>'Admin\CategoryController@create', 'as' => 'category-create', 'middleware'=> 'permission:Category Add|All'] );
  Route::post('/category/store','Admin\CategoryController@store');
  Route::get('/category/edit/{id}', ['uses' => 'Admin\CategoryController@edit', 'as' => 'category-edit', 'middleware'=> 'permission:Category Update|All']);
  Route::put('/category/edit/{id}', ['uses' => 'Admin\CategoryController@update', 'as' => 'category-update']);
  Route::put('/category/status/{id}', ['uses' => 'Admin\CategoryController@status', 'as' => 'category-status', 'middleware' => 'permission:Category Update|All']);
  Route::delete('/category/delete/{id}', ['uses' => 'Admin\CategoryController@destroy', 'as' => 'category-delete', 'middleware'=>'permission:Category Delete|All']);

  // Posts
  Route::get('/posts',['uses' => 'Admin\PostsController@index', 'as' => 'post-list', 'middleware'=> 'permission:Post List|All']);
  Route::get('/posts/create',['uses' =>'Admin\PostsController@create', 'as' => 'post-create', 'middleware'=> 'permission:Post Add|All'] );
  Route::post('/posts/store','Admin\PostsController@store');
  Route::put('/posts/status/{id}', ['uses' => 'Admin\PostsController@status', 'as' => 'post-status', 'middleware' => 'permission:Post Update|All']);
  Route::put('posts/hot_news/status/{id}', ['uses' => 'Admin\PostsController@hot_news', 'as' => 'post-hot-news', 'middleware' => 'permission:Post Update|All']);
  Route::get('/posts/edit/{id}', ['uses' => 'Admin\PostsController@edit', 'as' => 'post-edit', 'middleware'=> 'permission:Post Update|All']);
  Route::put('/posts/edit/{id}', ['uses' => 'Admin\PostsController@update', 'as' => 'post-update']);
  Route::delete('/posts/delete/{id}', ['uses' => 'Admin\PostsController@destroy', 'as' => 'post-delete', 'middleware'=>'permission:Post Delete|All']);

  //Comments
  Route::get('/comments/{id}', ['uses' => 'Admin\CommentsController@index', 'as' => 'comment-list', 'middleware'=> 'permission:Comment View|All']);
  Route::get('/comments/reply/{id}',['uses' =>'Admin\CommentsController@create', 'as' => 'comment-create', 'middleware'=> 'permission:Comment Reply|All'] );
  Route::post('/comments/reply/store','Admin\CommentsController@store');
  Route::put('/comments/status/{id}', ['uses' => 'Admin\CommentsController@status', 'as' => 'comment-status']);

  // Settings
  Route::get('/settings', ['uses' => 'Admin\SettingsController@index', 'as' => 'setting', 'middleware'=> 'permission:System Settings|All']);
  Route::put('/settings/update', ['uses' => 'Admin\SettingsController@update', 'as' => 'setting-update']);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
