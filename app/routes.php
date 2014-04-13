<?php

//Route::pattern('id', '[0-9]+');

Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('test', 'PagesController@test');

Route::resource('search', 'SearchController', ['only' => ['create', 'store']]);

Route::resource('sessions', 'SessionsController');
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');

Route::resource('users', 'UsersController');
Route::get('profile', 'UsersController@index');
Route::get('profile/{id}', 'UsersController@show');
Route::get('register', 'UsersController@create');

Route::resource('password', 'PasswordController', ['only' => ['create', 'store']]);
Route::get('password/forgot', 'PasswordController@create');
Route::get('password/reset', 'PasswordController@edit');
Route::get('password/reset/{token}', 'PasswordController@edit');
Route::post('password/{token}/update', 'PasswordController@update');

Route::get('ajax/getRating', 'AjaxController@getRating');

Route::get('tags/{tag}', ['as' => 'tags.index', 'uses' => 'TagsController@index']);
Route::get('grade/{tag}', ['as' => 'grades.index', 'uses' => 'GradesController@index']);

Route::get('{type}', ['as' => 'items.index', 'uses' => 'ItemsController@index']);
Route::get('{type}/create', ['as' => 'items.create', 'uses' => 'ItemsController@create']);
Route::post('{type}/store', ['as' => 'items.store', 'uses' => 'ItemsController@store']);
Route::get('{type}/{id}', ['as' => 'items.show', 'uses' => 'ItemsController@show']);
Route::delete('{type}/{id}/destroy', ['as' => 'items.destroy', 'uses' => 'ItemsController@destroy']);
Route::get('{type}/{id}/edit', ['as' => 'items.edit', 'uses' => 'ItemsController@edit']);
Route::put('{type}/{id}/update', ['as' => 'items.update', 'uses' => 'ItemsController@update']);

