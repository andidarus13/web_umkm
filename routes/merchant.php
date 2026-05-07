<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\MerchantController;

Route::middleware(['auth','role:merchant'])->prefix('merchant')->group(function () {

    Route::get('/', function () {
        return view('merchant.dashboard');
    });

    Route::resource('products', ProductController::class);

    // TOKO
    Route::get('store', [StoreController::class, 'index'])->name('store.index');
    Route::post('store', [StoreController::class, 'update'])->name('store.update');

    //DONWLOAD
    Route::get('/products/export/csv', [App\Http\Controllers\ProductController::class, 'exportCsv']);
    Route::get('/products/export/pdf', [App\Http\Controllers\ProductController::class, 'exportPdf']);

    Route::get('/store', [MerchantController::class, 'index']);
    Route::post('/store', [MerchantController::class, 'update'])->name('store.update');
});