<?php

Route::pattern('id', '[0-9]+');

Route::get('/', 'SystemsController@index');
Route::resource('systems', 'SystemsController');
Route::get('create', 'SystemsController@create');

Route::resource('sessions', 'SessionsController');
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');

Route::resource('users', 'UsersController');
Route::get('register', 'UsersController@create');

Route::get('about', 'PagesController@about');

//Route::resource('club', 'ClubController', ['only' => ['create', 'store', 'show']]);