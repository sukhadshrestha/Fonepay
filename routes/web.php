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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('payment', 'APIController@index');

Route::get('/getResponse', ['as' => 'payment', 'uses' => 'APIController@proceedPayment']);

Route::get('/redirectURL', 'APIController@getRedirect');

Route::get('/test', 'APIController@test');

