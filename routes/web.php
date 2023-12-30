<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::post('/add-cart/{productId}/{description}/{price}', [CartController::class, 'addCart'])->name('products.addCart');
Route::post('/update-cart/{rowId}', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/delete-product/{rowId}', [CartController::class, 'deleteCart'])->name('cart.delete');
Route::post('/delete-cart', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/store-cart', [CartController::class, 'store'])->name('cart.store');

Route::get('/carrito', [CartController::class,'index'])->name('carrito');

// Route::get('/add-cart', [CarritoController::class,'addCart'])->name('carrito.add');
