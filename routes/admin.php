<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\CategoryController;


Route::middleware(['auth','role:admin'])->prefix('admin')->group(function () {

    // ================= DASHBOARD =================
    Route::get('/', [AdminController::class, 'dashboard']);

    // ================= USERS =================
    Route::get('/users', [AdminController::class, 'users']);
    Route::post('/users/{id}/role', [AdminController::class, 'updateRole']);
    Route::post('/users', [AdminController::class, 'storeUser']);
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser']);

    // ================= MERCHANT =================
    Route::get('/merchants', [AdminController::class, 'merchants']);
    Route::post('/merchants/{id}/verify', [AdminController::class, 'verify']);
    Route::delete('/merchants/{id}', [AdminController::class, 'destroyMerchant']);

    // ================= REPORT =================

    // PRODUK
    Route::get('/reports/produk', [AdminReportController::class, 'produk']);

    // MERCHANT (VIEW + EXPORT)
    Route::get('/reports/merchant', [AdminReportController::class, 'merchant']);
    Route::get('/reports/merchant/csv', [AdminReportController::class, 'exportMerchantCsv']);
    Route::get('/reports/merchant/pdf', [AdminReportController::class, 'exportMerchantPdf']);

    // PENJUALAN (VIEW + EXPORT)
    Route::get('/reports/penjualan', [AdminReportController::class, 'penjualan']);
    Route::get('/reports/penjualan/csv', [AdminReportController::class, 'exportPenjualanCsv']);
    Route::get('/reports/penjualan/pdf', [AdminReportController::class, 'exportPenjualanPdf']);

    // STATISTIK
    Route::get('/reports/statistik', [AdminReportController::class, 'statistik']);

    //KATEGORI
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

});