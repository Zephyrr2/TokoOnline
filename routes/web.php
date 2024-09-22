<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/barang', [HomeController::class, 'tampilBarang']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register/process', [AuthController::class, 'reg']);
Route::get('/login',[AuthController::class, 'login']);
Route::post('/login/process', [AuthController::class, 'loginProcess']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/barang/admin', [HomeController::class, 'tampilBarangAdmin']);
Route::get('/barang/tambah', [HomeController::class, 'tambahBarang']);
Route::post('/barang/tambah/proses', [HomeController::class, 'prosesTambahBarang']);
Route::get('/barang/edit/{id_barang}', [HomeController::class, 'editBarang']);
Route::post('/barang/edit/proses', [HomeController::class, 'editBarangProcess']);
Route::delete('/barang/delete/', [HomeController::class, 'hapusBarang']);

Route::post('cart/process', [HomeController::class, 'addToCart']);
Route::get('cart', [HomeController::class, 'Cart']);
Route::post('cart/update', [HomeController::class, 'updateCart']);
Route::get('order/confirm', [HomeController::class, 'orderConfirm']);
Route::post('/order/process', [HomeController::class, 'checkoutProcess']);