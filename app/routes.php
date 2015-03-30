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
Route::get('users/revoke-permission', ['uses' => 'UsersController@revokePermission', 'as' => 'users.revokePermission']);
Route::get('users/change-password', ['uses' => 'UsersController@changePassword', 'as' => 'users.changePassword']);
Route::post('users/update-password', ['uses' => 'UsersController@updatePassword', 'as' => 'users.updatePassword']);

Route::resource('users', 'UsersController');

Route::resource('types', 'TypesController');

Route::resource('units', 'UnitsController');

Route::resource('customers', 'CustomersController');

Route::resource('suppliers', 'SuppliersController');

Route::get('products/search', ['uses' => 'ProductsController@search', 'as' => 'products.search', 'before' => 'sentry']);

Route::resource('products', 'ProductsController');

Route::resource('salesoutlets', 'SalesOutletsController');

Route::resource('stocks', 'StocksController');

Route::get('sales/{id}/returnitem', ['uses' => 'SalesController@returnitem', 'as' => 'sales.returnitem']);
Route::resource('sales', 'SalesController');

Route::resource('colors', 'ColorsController');

Route::get('outletdeposits/{id}/approve', ['uses' => 'OutletDepositsController@approve', 'as' => 'outletdeposits.approve']);
Route::get('outletdeposits/{id}/reject', ['uses' => 'OutletDepositsController@reject', 'as' => 'outletdeposits.reject']);
Route::resource('outletdeposits', 'OutletDepositsController');

Route::resource('distributions', 'DistributionsController');

Route::resource('vats', 'VatsController');

Route::get('stockreturns/{id}/approve', ['uses' => 'StockReturnsController@approve', 'as' => 'stockreturns.approve']);
Route::get('stockreturns/{id}/reject', ['uses' => 'StockReturnsController@reject', 'as' => 'stockreturns.reject']);
Route::get('stockreturns/{id}/return', ['uses'=>'StockReturnsController@returnStock','as' => 'stockreturns.return']);
Route::resource('stockreturns', 'StockReturnsController');

Route::resource('discounts', 'DiscountsController');
