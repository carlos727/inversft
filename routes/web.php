<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Home route
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * Authentication ruoutes
 */
Auth::routes();

/**
 * Credit routes
 */
Route::get('/home', 'CreditController@index')->name('home');
Route::get('/credit/create', 'CreditController@create')->name('create_credit');
Route::post('/credit/store', 'CreditController@store')->name('store_credit');
Route::delete('/credit/delete/{id}', 'CreditController@delete')->name('delete_credit');
Route::put('/credit/update/{id}', 'CreditController@update')->name('update_credit');

/**
 * Client routes
 */
Route::get('/client/show', 'ClientController@show')->name('list_clients');
Route::get('/client/create', 'ClientController@create')->name('create_client');
Route::post('/client/store', 'ClientController@store')->name('store_client');
Route::delete('/client/delete/{id}', 'ClientController@delete')->name('delete_client');
Route::put('/client/update/{id}', 'ClientController@update')->name('update_client');

/**
 *
 */
Route::get('/payment/show', 'PaymentController@show')->name('payments');
Route::post('/payment/store', 'PaymentController@store')->name('store_payment');
