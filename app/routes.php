<?php

//Route::pattern('id', '[0-9]+');

Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('test', 'PagesController@test');

Route::get('/social/{provider}/{action?}', ['as' => 'oauth.create', 'uses' => 'oAuthController@create']);
Route::post('/social/store', ['as' => 'oauth.store', 'uses' => 'oAuthController@store']);

Route::resource('search', 'SearchController', ['only' => ['create', 'store']]);

Route::post('sessions/store', ['as' => 'sessions.store', 'uses' => 'SessionsController@store']);
Route::get('login', ['as' => 'sessions.create', 'uses' => 'SessionsController@create']);
Route::get('logout', ['as' => 'sessions.destroy', 'uses' => 'SessionsController@destroy']);

Route::post('users/store', ['as' => 'users.store', 'uses' => 'UsersController@store']);
Route::get('profile', ['as' => 'users.show', 'uses' => 'UsersController@index']);
Route::get('profile/{id}', ['as' => 'users.show', 'uses' => 'UsersController@show']);
Route::get('register', ['as' => 'users.create', 'uses' => 'UsersController@create']);

Route::get('password/store', ['as' => 'passwords.store', 'uses' => 'PasswordController@store']);
Route::get('password/forgot', ['as' => 'passwords.create', 'uses' => 'PasswordController@create']);
Route::get('password/reset/{token}', ['as' => 'passwords.edit', 'uses' => 'PasswordController@edit']);
Route::post('password/{token}/update', ['as' => 'passwords.update', 'uses' => 'PasswordController@update']);

Route::get('ajax/getRating', ['as' => 'ajax.getrating', 'uses' => 'AjaxController@getRating']);
Route::get('ajax/getTags', ['as' => 'ajax.gettags', 'uses' => 'AjaxController@getTags']);


Route::get('tags/{tag}', ['as' => 'tags.index', 'uses' => 'TagsController@index']);
Route::get('grade/{tag}', ['as' => 'grades.index', 'uses' => 'GradesController@index']);

Route::get('{type}', ['as' => 'items.index', 'uses' => 'ItemsController@index']);
Route::get('{type}/create', ['as' => 'items.create', 'uses' => 'ItemsController@create']);
Route::post('{type}/store', ['as' => 'items.store', 'uses' => 'ItemsController@store']);
Route::get('{type}/{id}', ['as' => 'items.show', 'uses' => 'ItemsController@show']);
Route::delete('{type}/{id}/destroy', ['as' => 'items.destroy', 'uses' => 'ItemsController@destroy']);
Route::get('{type}/{id}/edit', ['as' => 'items.edit', 'uses' => 'ItemsController@edit']);
Route::put('{type}/{id}/update', ['as' => 'items.update', 'uses' => 'ItemsController@update']);

