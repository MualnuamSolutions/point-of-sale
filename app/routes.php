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
Route::get('/refresh', array('uses' => 'HomeController@refresh', 'as' => 'refresh'));

Route::get('users/logout', ['uses' => 'UsersController@logout', 'as' => 'users.logout']);
Route::get('users/login', ['uses' => 'UsersController@login', 'as' => 'users.login']);
Route::post('users/login/', ['uses' => 'UsersController@doLogin', 'as' => 'users.doLogin']);
Route::get('users/revoke-permission', ['uses' => 'UsersController@revokePermission', 'as' => 'users.revokePermission']);
Route::resource('users', 'UsersController');
Route::resource('types', 'TypesController');
Route::resource('units', 'UnitsController');
Route::resource('customers', 'CustomersController');
Route::resource('suppliers', 'SuppliersController');
Route::get('products/search', ['uses' => 'ProductsController@search', 'as' => 'products.search', 'before' => 'sentry']);
Route::resource('products', 'ProductsController');
Route::resource('salesoutlets', 'SalesOutletsController');
Route::resource('stocks', 'StocksController');
Route::resource('sales', 'SalesController');
Route::resource('colors', 'ColorsController');
Route::get('outletdeposits/{id}/approve', ['uses' => 'OutletDepositsController@approve', 'as' => 'outletdeposits.approve']);
Route::get('outletdeposits/{id}/reject', ['uses' => 'OutletDepositsController@reject', 'as' => 'outletdeposits.reject']);
Route::resource('outletdeposits', 'OutletDepositsController');
Route::resource('distributions', 'DistributionsController');
Route::resource('vats', 'VatsController');
Route::resource('stockreturns', 'StockReturnsController');
