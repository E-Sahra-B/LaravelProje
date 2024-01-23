<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HaberController;
use App\Http\Controllers\KategoriController;
use App\Jobs\MailSendJob;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

//Haber
Route::get('/haber', [HaberController::class, 'haberEkleForm'])->name('haber');
Route::get('/haberler', [HaberController::class, 'index'])->name('haberler');
Route::post('/haber-ekle', [HaberController::class, 'haberEkle'])->name('haber.ekle');
Route::get('/haber/duzenle/{id}', [HaberController::class, 'haberDuzenleForm'])->name('haber.duzenle');
Route::post('/haber/duzenle/{id}', [HaberController::class, 'haberDuzenleKaydet']);
Route::get('/haber/sil/{id}', [HaberController::class, 'haberSil'])->name('haber.sil');

//Kategori
Route::get('/kategoriler', [KategoriController::class, 'index'])->name('kategoriler');
Route::get('/kategori/ekle', [KategoriController::class, 'kategoriEkleForm'])->name('kategori.ekle');
Route::post('/kategori/ekle', [KategoriController::class, 'kategoriEkle']);
Route::get('/kategori/{id}/duzenle', [KategoriController::class, 'kategoriDuzenleForm'])->name('kategori.duzenle');
Route::post('/kategori/{id}/duzenle', [KategoriController::class, 'kategoriDuzenleKaydet']);
Route::get('/kategori/{id}/sil', [KategoriController::class, 'kategoriSil'])->name('kategori.sil');

Route::get('/queue', function () {
    $user = User::find(1);
    MailSendJob::dispatch($user)->onQueue('high')->delay(now()->addSecond(20));
    dd("Sended E-Mail Queue");
});

Route::post('/clear-cache', [KategoriController::class, 'clearCache'])->name('clear.cache');
