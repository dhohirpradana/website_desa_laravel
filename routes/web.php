<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home.index');

// Auth
Route::get('/masuk', 'AuthController@index')->name('masuk.index');
Route::post('/masuk', 'AuthController@masuk')->name('masuk');
Route::patch('/keluar', 'AuthController@keluar')->name('keluar');

// User
Route::get('/profil', 'UserController@profil')->name('profil');
