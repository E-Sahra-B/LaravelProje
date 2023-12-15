<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HaberController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserMailController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('/haberler', [HaberController::class, 'getNews'])->name('haberler');
    Route::get('/haberler/{id}', [HaberController::class, 'apiDetail']);
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('/kategoriler', [KategoriController::class, 'getCategories']);
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('/addmail', [UserMailController::class, 'addMail']);
});
