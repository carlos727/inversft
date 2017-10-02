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
Route::get('/home/{collector_id?}', 'CreditController@index')->name('home');
Route::get('/credit/create', 'CreditController@create')->name('create_credit');
Route::get('/credit/download/{collector_id?}', 'CreditController@download')->name('download_credits');
Route::get('/credit/{id}/status', 'CreditController@status');
Route::post('/credit/store', 'CreditController@store')->name('store_credit');
Route::delete('/credit/{id}/delete', 'CreditController@delete')->name('delete_credit');
Route::put('/credit/{id}/update', 'CreditController@update')->name('update_credit');

/**
 * Client routes
 */
Route::get('/client/show', 'ClientController@show')->name('list_clients');
Route::get('/client/create', 'ClientController@create')->name('create_client');
Route::post('/client/store', 'ClientController@store')->name('store_client');
Route::delete('/client/{id}/delete', 'ClientController@delete')->name('delete_client');
Route::put('/client/{id}/update', 'ClientController@update')->name('update_client');

/**
 * Payment routes
 */
Route::get('/payment/show', 'PaymentController@show')->name('payments');
Route::post('/payment/store', 'PaymentController@store')->name('store_payment');
Route::delete('/payment/{id}/delete', 'PaymentController@delete')->name('delete_payment');

/**
 * Collector routes
 */
Route::get('/collector/show/{active?}', 'CollectorController@show')->name('list_collectors');
Route::get('/collector/create', 'CollectorController@create')->name('create_collector');
Route::get('/collector/{id}/credits', 'CollectorController@credits')->name('credits_collector');
Route::get('/collector/{id}/status', 'CollectorController@change_status')->name('change_status_collector');
Route::post('/collector/store', 'CollectorController@store')->name('store_collector');
Route::delete('/collector/{id}/delete', 'CollectorController@delete')->name('delete_collector');
Route::put('/collector/{id}/update', 'CollectorController@update')->name('update_collector');