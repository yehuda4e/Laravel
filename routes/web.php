<?php

Auth::routes();

Route::get('/', 'ArticleController@index');


Route::get('user/settings', 'UserController@general');
Route::patch('user/settings', 'UserController@update');
Route::get('user/settings/avatar', 'UserController@avatar');
Route::patch('user/settings/avatar', 'UserController@updateAvatar');
Route::get('user/settings/password', 'UserController@password');
Route::patch('user/settings/password', 'UserController@updatePassword');
Route::get('user/settings/signature', 'UserController@signature');
Route::patch('user/settings/signature', 'UserController@updateSign');
Route::get('user/{user}/{username?}', 'UserController@show');

Route::get('category/{category}/{name?}', 'ForumCategoryController@show');

Route::get('forum', 'ForumController@index');
Route::get('forum/{forum}/{name?}', 'ForumController@show');

Route::get('topic/{forum}/create', 'TopicController@create');
Route::post('topic/{forum}/store', 'TopicController@store');
Route::get('topic/{topic}/{subject?}', 'TopicController@show');
Route::post('topic/{topic}/comment', 'TopicController@comment');


Route::group([
	'prefix' => 'admin',
	'namespace' => 'Admin',
	'middleware' => 'auth'], function() {

	Route::get('/', 'AdminController@index');
	Route::resource('forum', 'ForumController');
	Route::resource('group', 'GroupController');
	Route::resource('user', 'UserController');
	Route::resource('article', 'ArticleController');
	Route::resource('category', 'CategoryController');
	Route::resource('forumcat', 'ForumCategoryController');
});

Route::get('article/cat/{name}', 'ArticleController@category');
Route::get('article/tag/{tag}', 'ArticleController@tag');
Route::post('article/{article}/comment', 'ArticleController@comment');
Route::get('{article}', 'ArticleController@show');

