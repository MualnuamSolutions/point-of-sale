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

Route::get('/', ['before' => 'sentry', 'uses' => 'HomeController@index', 'as' => 'home']);

Route::get('user/logout', ['uses' => 'UserController@logout', 'as' => 'user.logout']);
Route::get('user/login', ['uses' => 'UserController@login', 'as' => 'user.login']);
Route::post('user/login/', ['uses' => 'UserController@doLogin', 'as' => 'user.doLogin']);
Route::resource('user', 'UserController');
Route::resource('types', 'TypesController');
Route::resource('units', 'UnitsController');
Route::resource('products', 'ProductsController');
Route::resource('customers', 'CustomersController');
Route::resource('suppliers', 'SuppliersController');
Route::resource('products', 'ProductsController');

Route::get('/refresh', ['uses' => 'HomeController@refresh', 'as' => 'refresh']);
