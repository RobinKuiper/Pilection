<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::resource('systems', 'SystemsController');
Route::get('/', 'SystemsController@index');
Route::get('systems/{id}', 'SystemsController@show')->where('id', '\d+');
Route::get('create', 'SystemsController@create')->before('auth');
Route::get('systems/create', 'SystemsController@create')->before('auth');

Route::resource('sessions', 'SessionsController');
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');