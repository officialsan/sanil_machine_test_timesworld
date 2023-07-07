<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
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
Route::get('/', [ProductController::class, 'index'])->name('product-list');
Route::get('/product-add', [ProductController::class, 'create'])->name('product-add');
Route::post('/product-add', [ProductController::class, 'storeOrUpdate'])->name('product-store');
Route::get('/product-edit/{id}', [ProductController::class, 'edit'])->name('product-edit');
Route::post('/product-update/', [ProductController::class, 'storeOrUpdate'])->name('product-update');
Route::get('/product-delete/{id}', [ProductController::class, 'destroy'])->name('product-delete');

Route::get('/variants', [VariantController::class, 'index'])->name('variant-list');
Route::get('/variant-add', [VariantController::class, 'create'])->name('variant-add');
Route::post('/variant-add', [VariantController::class, 'storeOrUpdate'])->name('variant-store');
Route::get('/variant-edit/{id}', [VariantController::class, 'edit'])->name('variant-edit');
Route::post('/variant-update/', [VariantController::class, 'storeOrUpdate'])->name('variant-update');
Route::get('/variant-delete/{id}', [VariantController::class, 'destroy'])->name('variant-delete');