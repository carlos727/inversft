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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'CreditController@index')->name('home');
Route::get('/credit/create', 'CreditController@create')->name('create_credit');
Route::post('/credit/store', 'CreditController@store')->name('credit');

Route::get('/client/show', 'ClientController@show')->name('clients');
Route::get('/client/create', 'ClientController@create')->name('create_client');
Route::post('/client/store', 'ClientController@store')->name('client');
