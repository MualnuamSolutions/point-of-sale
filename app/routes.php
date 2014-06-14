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

Route::get('users/logout', ['uses' => 'UsersController@logout', 'as' => 'users.logout']);
Route::get('users/login', ['uses' => 'UsersController@login', 'as' => 'users.login']);
Route::post('users/login/', ['uses' => 'UsersController@doLogin', 'as' => 'users.doLogin']);
Route::resource('users', 'UsersController');
Route::resource('types', 'TypesController');
Route::resource('units', 'UnitsController');
Route::resource('products', 'ProductsController');
Route::resource('customers', 'CustomersController');
Route::resource('suppliers', 'SuppliersController');
Route::resource('products', 'ProductsController');
Route::resource('salesoutlets', 'SalesOutletsController');
Route::resource('stocks', 'StocksController');
Route::resource('sales', 'SalesController');

Route::get('/refresh', ['uses' => 'HomeController@refresh', 'as' => 'refresh']);
