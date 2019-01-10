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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::post('/check', 'HomeController@check');

Route::get('/home', 'AppController@index')->name('index');
Route::get('/profile', 'AppController@profile')->name('profile');
Route::post('/profile', 'AppController@submitProfile')->name('submitProfile');
