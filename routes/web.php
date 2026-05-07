<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\ProductPublicController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| LANDING (HOME) + SEARCH + FILTER
|--------------------------------------------------------------------------
*/
Route::get('/', [ProductPublicController::class, 'home'])->name('home');

/*
|--------------------------------------------------------------------------
| CATALOG (LIST + PAGINATION)
|--------------------------------------------------------------------------
*/
Route::get('/produk', [ProductPublicController::class, 'catalog'])->name('produk');

/*
|--------------------------------------------------------------------------
| DETAIL PRODUK (SLUG)
|--------------------------------------------------------------------------
*/
Route::get('/product/{slug}', [ProductPublicController::class, 'show'])->name('product.show');

/*
|--------------------------------------------------------------------------
| REDIRECT ROLE
|--------------------------------------------------------------------------
*/
Route::get('/redirect', function () {
    if (!auth()->check()) return redirect('/login');

    return match (auth()->user()->role) {
        'admin' => redirect('/admin'),
        'merchant' => redirect('/merchant'),
        default => redirect('/'),
    };
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'login']);

Route::get('/register', [AuthController::class,'showRegister']);
Route::post('/register', [AuthController::class,'register']);

Route::post('/logout', [AuthController::class,'logout'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| OTHER
|--------------------------------------------------------------------------
*/
require __DIR__.'/admin.php';
require __DIR__.'/merchant.php';