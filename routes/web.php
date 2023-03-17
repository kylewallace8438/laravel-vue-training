<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'show'])->name('shop');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/blog', [App\Http\Controllers\HomeController::class, 'blog'])->name('blog');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/service', [App\Http\Controllers\HomeController::class, 'service'])->name('service');
Route::get('/cart', [CartController::class, 'show'])->name('cart');
Route::post('/cart', [CartController::class, 'add_cart'])->name('add.cart');
Route::get('/checkout', [CartController::class, 'check_out'])->name('checkout');
Route::get('/thankyou', [CartController::class, 'thank'])->name('thankyou');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
