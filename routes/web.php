<?php

use App\Http\Controllers\SuratController;
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
Route::get('/beranda', 'HomeController@index')->name('beranda');
Route::get('/buat-surat/{id}/{slug}', 'SuratController@buat')->name('buat-surat');
Route::post('/buat-surat/{buat-surat}', 'SuratController@show')->name('buat-surat.download');

Route::group(['middleware' => ['web', 'guest']], function () {

    Route::get('/masuk', 'AuthController@index')->name('masuk');
    Route::post('/masuk', 'AuthController@masuk');

});

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::post('/keluar', 'AuthController@keluar')->name('keluar');
    Route::get('/pengaturan', 'UserController@pengaturan')->name('pengaturan');
    Route::get('/profil', 'UserController@profil')->name('profil');
    Route::patch('/update-pengaturan/{user}', 'UserController@updatePengaturan')->name('update-pengaturan');
    Route::patch('/update-profil/{user}', 'UserController@updateProfil')->name('update-profil');

    Route::get('/tambah-surat', 'SuratController@create')->name('surat.create');
    Route::resource('/surat', 'SuratController')->except('create');

    Route::resource('/isiSurat', 'IsiSuratController')->except('index', 'create', 'edit', 'show');

    Route::resource('/gallery', 'GalleryController')->except('show','edit');

});
