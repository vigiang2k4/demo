<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Client\ClientController;

use App\Http\Controllers\User\UserController;
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

// Các route cho Account
Route::controller(AccountController::class)->group(function () {
    // Đăng ký
    Route::get('register', 'register')->name('register');
    Route::post('register', 'register_')->name('register_');
    // Đăng nhập
    Route::get('login', 'login')->name('login');
    Route::post('login', 'login_')->name('login_');
    // Cập nhật tài khoản
    Route::get('/user/edit', 'edit')->name('edit');
    Route::post('/user/update', 'update')->name('update');
    // Quên mật khẩu
    Route::get('password/forgot', 'forgot')->name('forgot');
    Route::post('password/forgot', 'forgot_')->name('forgot_');
    // Đặt lại mật khẩu sau khi send mail
    Route::get('password/reset/{token}', 'password')->name('password');
    Route::post('password/reset', 'password_')->name('password_');
    // Xác thực email
    Route::get('/verify', 'verify')->name('verify')->middleware('auth');
    Route::get('/verify/{id}/{hash}', 'verifydone')->name('verifydone');

    // Đăng xuất
    Route::post('logout', 'logout')->name('logout');
});

// Route cho Admin
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/dashboard',  'index')->name('admin.dashboard');

    Route::Resource('categories', CategoryController::class);
    Route::Resource('products', ProductController::class);
    Route::Resource('colors', ColorController::class);
    Route::Resource('sizes', SizeController::class);
});

// Route cho User
Route::controller(UserController::class)->middleware(['user'])->group(function () {
    Route::get('/user/dashboard', 'user')->name('user.dashboard');
});

// Route cho client
Route::controller(ClientController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/detail/{id}', 'show')->name('detail');
    Route::get('/shop', 'shop')->name('shop');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
});
