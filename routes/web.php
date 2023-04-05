<?php

use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\Auth\RegisterController as AdminRegisterController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
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
Route::get('/gift', [App\Http\Controllers\HomeController::class, 'gift'])->name('gift');
Route::get('/gift/{id}', [App\Http\Controllers\HomeController::class, 'edit_point'])->name('gift.point');
Route::get('/blog', [App\Http\Controllers\HomeController::class, 'blog'])->name('blog');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/service', [App\Http\Controllers\HomeController::class, 'service'])->name('service');
Route::get('/customer', [App\Http\Controllers\HomeController::class, 'customer'])->name('customer');

// cart
Route::get('/cart', [CartController::class, 'show'])->name('cart');
Route::post('/cart', [CartController::class, 'add_cart'])->name('add.cart');
Route::any('/cart/{id}', [CartController::class, 'remove_product'])->name('remove.product.cart');
Route::any('/applycoupon', [CartController::class, 'apply_coupon'])->name('applyCoupon.cart');
Route::any('/cancelcoupon', [CartController::class, 'remove_coupon'])->name('remove.coupon.cart');
Route::any('/cancelcoupon/checkout', [CartController::class, 'remove_coupon_inCheckout'])->name('remove.coupon.checkout');
Route::get('/checkout', [CartController::class, 'check_out'])->name('checkout');
Route::get('/thankyou', [CartController::class, 'thank'])->name('thankyou');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('formLogin');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'showRegister'])->name('formRegister');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Admin login
Route::get('/admin/login', [AdminLoginController::class, 'form_login'])->name('formLoginAdmin');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');

Route::get('/admin', [AdminHomeController::class, 'dashboard'])->name('admin.home');
Route::get('/admin/products', [AdminProductController::class, 'product'])->name('products.list');
Route::get('/admin/products/{id}', [AdminProductController::class, 'show'])->name('products.detail');
Route::delete('/admin/products/{id}', [AdminProductController::class, 'delete'])->name('products.delete');

//Admin register
Route::get('/admin/register', [AdminRegisterController::class, 'form_register'])->name('formRegisterAdmin');
Route::post('/admin/register', [AdminRegisterController::class, 'register'])->name('admin.register');

//Admin logout
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::get('/admin/customers', [CustomerController::class, 'index'])->name('customers.list');
Route::get('/admin/customers/{id}', [CustomerController::class, 'show'])->name('customers.detail');

Route::get('/admin/list', [AdminHomeController::class, 'admin_list'])->name('admins.list');
Route::get('/admin/orders', [AdminHomeController::class, 'order'])->name('orders.list');

Route::get('/admin/coupon/create', [AdminCouponController::class, 'show_createCoupon'])->name('coupon.create');
Route::post('/admin/coupon/create', [AdminCouponController::class, 'create_Coupon'])->name('coupon.create.store');
Route::get('/admin/coupon/list', [AdminCouponController::class, 'show_ListCoupon'])->name('coupon.list');
Route::get('/admin/coupon/delete/{id}', [AdminCouponController::class, 'deleteCoupon'])->name('coupon.delete');

Route::get('/admin/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.detail');
Route::post('/admin/orders/{id}', [AdminHomeController::class, 'confirmOrder'])->name('orders.confirm');
Route::delete('/admin/orders/{id}', [AdminOrderController::class, 'delete'])->name('orders.delete');

Route::get('/admin/profile/{id}', [AdminRoleController::class, 'profile'])->name('admin.profile');
Route::post('/admin/profile/{id}', [AdminRoleController::class, 'update'])->name('admin.update.role');
Route::get('/admin/role', [AdminRoleController::class, 'index'])->name('admin.role.list');
Route::post('/admin/role', [AdminRoleController::class, 'create'])->name('admin.role.create');

Route::get('/admin/productsAdd', [AdminProductController::class, 'add_product_show'])->name('products.add.form');

// Route::get('/admin/products/add', [AdminHomeController::class, 'add_product'])->name('products.add.show');
Route::post('/admin/products/add', [AdminProductController::class, 'add_product'])->name('products.add');
Route::get('/admin/products/edit/{id}', [AdminProductController::class, 'edit_product'])->name('products.edit.show');
Route::post('/admin/products/edit/{id}', [AdminProductController::class, 'update_product'])->name('products.edit');

Route::get('/admin/events', [AdminEventController::class, 'event'])->name('events.list');
Route::get('/admin/events/add', [AdminEventController::class, 'show'])->name('events.add.show');
Route::post('/admin/events/add', [AdminEventController::class, 'add_event'])->name('events.add');
Route::get('/admin/events/edit/{id}', [AdminEventController::class, 'edit'])->name('events.edit');
Route::get('/admin/events/delete/{id}', [AdminEventController::class, 'delete'])->name('events.delete');
Route::get('/admin/exchange', [AdminEventController::class, 'exchange'])->name('exchange');
Route::get('/admin/exchange/add', [AdminEventController::class, 'add_exchange_show'])->name('exchange.add.show');
Route::post('/admin/exchange/add', [AdminEventController::class, 'add_exchange'])->name('exchange.add');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
