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
Route::get('/sejarah', 'SejarahController@sejarah')->name('sejarah');
Route::get('/sejarah/{sejarah}/{slug}', 'SejarahController@show')->name('sejarah.show');
Route::get('/berita', 'BeritaController@berita')->name('berita');
Route::get('/berita/{berita}/{slug}', 'BeritaController@show')->name('berita.show');
Route::get('/gallery', 'GalleryController@gallery')->name('gallery');
Route::get('/buat-surat/{id}/{slug}', 'CetakSuratController@create')->name('buat-surat');
Route::get('/panduan', 'HomeController@panduan')->name('panduan');
Route::post('/cetak-surat/{id}/{slug}', 'CetakSuratController@store')->name('cetak-surat.store');

Route::get('/statistik-penduduk/pekerjaan', 'GrafikController@pekerjaan')->name('statistik-penduduk.pekerjaan');
Route::get('/statistik-penduduk/pendidikan', 'GrafikController@pendidikan')->name('statistik-penduduk.pendidikan');
Route::get('/statistik-penduduk/agama', 'GrafikController@agama')->name('statistik-penduduk.agama');
Route::get('/statistik-penduduk/usia', 'GrafikController@usia')->name('statistik-penduduk.usia');
Route::get('/statistik-penduduk/golongan-darah', 'GrafikController@darah')->name('statistik-penduduk.darah');
Route::get('/statistik-penduduk/status-perkawinan', 'GrafikController@perkawinan')->name('statistik-penduduk.perkawinan');

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
    Route::resource('/cetakSurat', 'CetakSuratController')->except('create','store','index');
    Route::resource('/surat', 'SuratController')->except('create');

    Route::get('/kelola-sejarah', 'SejarahController@index')->name('sejarah.index');
    Route::get('/tambah-sejarah', 'SejarahController@create')->name('sejarah.create');
    Route::get('/edit-sejarah/{sejarah}', 'SejarahController@edit')->name('sejarah.edit');
    Route::resource('/sejarah', 'SejarahController')->except('create','show','index','edit');

    Route::get('/kelola-berita', 'BeritaController@index')->name('berita.index');
    Route::get('/tambah-berita', 'BeritaController@create')->name('berita.create');
    Route::get('/edit-berita/{berita}', 'BeritaController@edit')->name('berita.edit');
    Route::resource('/berita', 'BeritaController')->except('create','show','index','edit');

    Route::resource('/isiSurat', 'IsiSuratController')->except('index', 'create', 'edit', 'show');

    Route::post('/gallery/store', 'GalleryController@storeGallery')->name('gallery.storeGallery');
    Route::get('/kelola-gallery', 'GalleryController@index')->name('gallery.index');
    Route::resource('/gallery', 'GalleryController')->except('index','show', 'edit', 'update', 'create');

    Route::get('/tambah-slider', 'GalleryController@create')->name('slider.create');
    Route::get('/slider', 'GalleryController@indexSlider')->name('slider.index');

    Route::post('/video', 'VideoController@store')->name('video.store');
    Route::patch('/video/update', 'VideoController@update')->name('video.update');

    Route::get('/surat-harian', 'HomeController@suratHarian')->name('surat-harian');
    Route::get('/surat-bulanan', 'HomeController@suratBulanan')->name('surat-bulanan');
    Route::get('/surat-tahunan', 'HomeController@suratTahunan')->name('surat-tahunan');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

    Route::get('/tambah-penduduk', 'PendudukController@create')->name('penduduk.create');
    Route::resource('penduduk', 'PendudukController')->except('create','show');

    Route::get('/kelompok-jenis-anggaran/{kelompokJenisAnggaran}', 'AnggaranRealisasiController@kelompokJenisAnggaran');
    Route::get('/detail-jenis-anggaran/{id}', 'AnggaranRealisasiController@show')->name('anggaran-realisasi.show');
    Route::get('/tambah-anggaran-realisasi', 'AnggaranRealisasiController@create')->name('anggaran-realisasi.create');
    Route::resource('anggaran-realisasi', 'AnggaranRealisasiController')->except('create','show');

    Route::get('/tambah-dusun', 'DusunController@create')->name('dusun.create');
    Route::resource('dusun', 'DusunController')->except('create','show');
    Route::resource('detailDusun', 'DetailDusunController')->except('create','edit');

    Route::get('/chart-surat/{id}', 'SuratController@chartSurat')->name('chart-surat');
});
