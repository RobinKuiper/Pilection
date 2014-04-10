<?php

Route::pattern('id', '[0-9]+');

Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');

Route::resource('search', 'SearchController', ['only' => ['create', 'store']]);

Route::resource('sessions', 'SessionsController');
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');

Route::resource('users', 'UsersController');
Route::get('register', 'UsersController@create');

Route::get('{type}', ['as' => 'items.index', 'uses' => 'ItemsController@index']);
Route::get('{type}/create', 'ItemsController@create');
Route::post('{type}/store', 'ItemsController@store');
Route::get('{type}/{id}', ['as' => 'items.show', 'uses' => 'ItemsController@show']);
Route::delete('{type}/{id}/destroy', ['as' => 'items.destroy', 'uses' => 'ItemsController@destroy']);
Route::get('{type}/{id}/edit', ['as' => 'items.edit', 'uses' => 'ItemsController@edit']);
Route::put('{type}/{id}/update', ['as' => 'items.update', 'uses' => 'ItemsController@update']);