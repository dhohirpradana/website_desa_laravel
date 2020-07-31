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
Route::get('/beranda', 'HomeController@index')->name('beranda');
Route::get('/sejarah', 'SejarahController@sejarah')->name('sejarah');
Route::get('/gallery', 'GalleryController@gallery')->name('gallery');
Route::get('/buat-surat/{id}/{slug}', 'SuratController@buat')->name('buat-surat');
Route::get('/panduan', 'HomeController@panduan')->name('panduan');
Route::post('/buat-surat/{id}', 'SuratController@show')->name('buat-surat.download');

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

    Route::get('/profil-desa', 'DesaController@index')->name('profil-desa');
    Route::patch('/update-desa/{desa}', 'DesaController@update')->name('update-desa');

    Route::get('/tambah-surat', 'SuratController@create')->name('surat.create');
    Route::resource('/surat', 'SuratController')->except('create');

    Route::get('/kelola-sejarah', 'SejarahController@index')->name('sejarah.index');
    Route::get('/tambah-sejarah', 'SejarahController@create')->name('sejarah.create');
    Route::resource('/sejarah', 'SejarahController')->except('create','show','index');
    Route::get('/sejarah/{sejarah}/{slug}', 'SejarahController@show')->name('sejarah.show');

    Route::resource('/isiSurat', 'IsiSuratController')->except('index', 'create', 'edit', 'show');

    Route::post('/gallery/store', 'GalleryController@storeGallery')->name('gallery.storeGallery');
    Route::get('/kelola-gallery', 'GalleryController@index')->name('gallery.index');
    Route::resource('/gallery', 'GalleryController')->except('index','show', 'edit', 'update', 'create');

    Route::get('/tambah-slider', 'GalleryController@create')->name('slider.create');
    Route::get('/slider', 'GalleryController@indexSlider')->name('slider.index');

    Route::post('/video', 'VideoController@store')->name('video.store');
    Route::patch('/video/update', 'VideoController@update')->name('video.update');
});
