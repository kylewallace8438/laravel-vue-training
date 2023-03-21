<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/blog', [App\Http\Controllers\HomeController::class, 'blog'])->name('blog');
Route::post('/cart', [OrderController::class, 'add_cart'])->name('add_cart');
Route::get('/cart', [App\Http\Controllers\OrderController::class, 'show'])->name('cart');
Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services']) ->name('services');
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'show'])->name('shop');
Route::get('/thankyou', [App\Http\Controllers\OrderController::class, 'thankyou'])->name('thankyou');
