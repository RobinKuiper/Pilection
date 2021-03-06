<?php

//Route::pattern('id', '[0-9]+');
Route::when('*', 'csrf', array('post', 'put', 'delete'));

/* Pages */
Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('request', ['as' => 'pages.request', 'uses' => 'PagesController@request']);

/* oAuth/Social login */
Route::get('social', ['as' => 'oauth.index', 'uses' => 'oAuthController@index']);
Route::get('/social/{provider}/{action?}', ['as' => 'oauth.create', 'uses' => 'oAuthController@create']);
Route::post('/social/store', ['as' => 'oauth.store', 'uses' => 'oAuthController@store']);

/* Search */
Route::resource('search', 'SearchController', ['only' => ['create', 'store']]);

/* Sessions/Login/Logout */
Route::post('sessions/store', ['as' => 'sessions.store', 'uses' => 'SessionsController@store']);
Route::get('login', ['as' => 'sessions.create', 'uses' => 'SessionsController@create']);
Route::get('logout', ['as' => 'sessions.destroy', 'uses' => 'SessionsController@destroy']);

/* Register/Profile */
Route::get('register', ['as' => 'users.create', 'uses' => 'UsersController@create']);
Route::post('users/store', ['as' => 'users.store', 'uses' => 'UsersController@store']);
Route::get('profile/edit', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
Route::get('profile/edit/{active}', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
Route::post('profile/update', ['as' => 'users.update', 'uses' => 'UsersController@update']);
Route::get('profile', ['as' => 'users.index', 'uses' => 'UsersController@index']);
Route::get('profile/{id}', ['as' => 'users.show', 'uses' => 'UsersController@show']);

/* Settings */
//Route::get('settings', ['as' => 'settings.edit', 'uses' => 'SettingsController@edit']);
//Route::post('settings/update', ['as' => 'settings.update', 'uses' => 'SettingsController@update']);

/* Forgot Password */
Route::post('password/store', ['as' => 'passwords.store', 'uses' => 'PasswordController@store']);
Route::get('password/forgot', ['as' => 'passwords.create', 'uses' => 'PasswordController@create']);
Route::get('password/reset/{token}', ['as' => 'passwords.edit', 'uses' => 'PasswordController@edit']);
Route::post('password/{token}/update', ['as' => 'passwords.update', 'uses' => 'PasswordController@update']);

/* Email validation */
Route::get('validation/{id}/{token}', ['as' => 'validation.create', 'uses' => 'ValidationController@create']);

/* Ajax */
Route::get('ajax/getRating', ['as' => 'ajax.getrating', 'uses' => 'AjaxController@getRating']);
Route::get('ajax/getTags', ['as' => 'ajax.gettags', 'uses' => 'AjaxController@getTags']);

/* Items */
Route::get('tag/{attr}', ['as' => 'tag.index', 'uses' => 'ItemsController@index']);
Route::get('grade/{attr}', ['as' => 'grade.index', 'uses' => 'ItemsController@index']);

Route::get('{type}', ['as' => 'items.index', 'uses' => 'ItemsController@index']);
Route::get('{type}/create', ['as' => 'items.create', 'uses' => 'ItemsController@create']);
Route::post('{type}/store', ['as' => 'items.store', 'uses' => 'ItemsController@store']);
Route::get('{type}/{id}', ['as' => 'items.show', 'uses' => 'ItemsController@show']);
Route::delete('{type}/{id}/destroy', ['as' => 'items.destroy', 'uses' => 'ItemsController@destroy']);
Route::get('{type}/{id}/edit', ['as' => 'items.edit', 'uses' => 'ItemsController@edit']);
Route::put('{type}/{id}/update', ['as' => 'items.update', 'uses' => 'ItemsController@update']);
