<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HaberController;
use App\Http\Controllers\KategoriController;
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


Route::get('/haber', [HaberController::class, 'haberEkleForm'])->name('haber');
Route::get('/haberler', [HaberController::class, 'index'])->name('haberler');
Route::post('/haber-ekle', [HaberController::class, 'haberEkle'])->name('haber.ekle');
Route::get('/haber/duzenle/{id}', [HaberController::class, 'haberDuzenleForm'])->name('haber.duzenle');
Route::post('/haber/duzenle/{id}', [HaberController::class, 'haberDuzenleKaydet'])->name('haber.duzenle.kaydet');
Route::get('/haber/sil/{id}', [HaberController::class, 'haberSil'])->name('haber.sil');

//Kategori
Route::get('/kategoriler', [KategoriController::class, 'index'])->name('kategoriler');
Route::get('/kategori/ekle', [KategoriController::class, 'kategoriEkleForm'])->name('kategori.ekle.form');
Route::post('/kategori/ekle', [KategoriController::class, 'kategoriEkle'])->name('kategori.ekle');
Route::get('/kategori/{id}/duzenle', [KategoriController::class, 'kategoriDuzenleForm'])->name('kategori.duzenle.form');
Route::post('/kategori/{id}/duzenle', [KategoriController::class, 'kategoriDuzenleKaydet'])->name('kategori.duzenle.kaydet');
Route::get('/kategori/{id}/sil', [KategoriController::class, 'kategoriSil'])->name('kategori.sil');

Route::post('/clear-cache', [KategoriController::class, 'clearCache'])->name('clear.cache');
