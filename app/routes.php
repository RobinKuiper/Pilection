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

Route::get('tags/{tag}', ['as' => 'tags.index', 'uses' => 'TagsController@index']);

Route::get('{type}', ['before' => 'type', 'as' => 'items.index', 'uses' => 'ItemsController@index']);
Route::get('{type}/create', ['before' => 'type', 'as' => 'items.create', 'uses' => 'ItemsController@create']);
Route::post('{type}/store', ['before' => 'type', 'as' => 'items.store', 'uses' => 'ItemsController@store']);
Route::get('{type}/{id}', ['before' => 'type', 'as' => 'items.show', 'uses' => 'ItemsController@show']);
Route::delete('{type}/{id}/destroy', ['before' => 'type', 'as' => 'items.destroy', 'uses' => 'ItemsController@destroy']);
Route::get('{type}/{id}/edit', ['before' => 'type', 'as' => 'items.edit', 'uses' => 'ItemsController@edit']);
Route::put('{type}/{id}/update', ['before' => 'type', 'as' => 'items.update', 'uses' => 'ItemsController@update']);