<?php

use App\Http\Controllers\Home;
use App\Http\Controllers\Admin;
use VulcanPhp\PhpRouter\Route;

// @admin routes
Route::form('/admin', [Admin::class, 'index'])->name('admin');

// @public routes
Route::get('/', [Home::class, 'index'])->name('store');
Route::get('/invoice/{id}', [Home::class, 'invoice'])->name('invoice');
Route::view('/success/', 'success')->name('success');
Route::view('/error/', 'error')->name('error');
Route::view('/cart/', 'cart')->name('cart');
Route::view('/checkout/', 'checkout')->name('checkout');
Route::post('/order', [Home::class, 'order'])->name('order');
Route::get('/category/{category}', [Home::class, 'index'])->name('category');
Route::form('/search/', [Home::class, 'search'])->name('search');
Route::view('/delivery/', 'delivery')->name('delivery');
Route::form('/myorders/', [Home::class, 'myorders'])->name('myorders');
Route::get('/{id}', [Home::class, 'product'])->name('product');
