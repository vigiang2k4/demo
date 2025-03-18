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

Route::get('/', function () {
    return view('client.layout.master');
});

// Các route cho Account
Route::controller(AccountController::class)->group(function () {
    // Đăng ký
    Route::get('register', 'register')->name('register.form');
    Route::post('register', 'register_')->name('register');

    // Đăng nhập
    Route::get('login', 'login')->name('login.form');
    Route::post('login', 'login_')->name('login');

    // Quên mật khẩu
    Route::get('password/forgot', 'rspassword')->name('password.forgot.form');
    Route::post('password/forgot', 'rspassword_')->name('password.forgot');

    // Đặt lại mật khẩu
    Route::get('password/reset/{token}', 'updatepassword')->name('password.reset');
    Route::post('password/reset', 'updatepassword_')->name('password.update');

    // Xác thực email
    Route::get('/verify', 'verify')->name('verify')->middleware('auth');
    Route::get('/verify/{id}/{hash}', 'verifydone')->name('verification.verify');

    // Đăng xuất
    Route::post('logout', 'logout')->name('logout');
});

// Route cho Admin
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/dashboard',  'index')->name('admin.dashboard');
    // Đổi mật khẩu
    Route::get('/admin/change-password', 'changepass')->name('admin.changepass.form');
    Route::post('/admin/change-password', 'changepass_')->name('admin.password.change');
    // Cập nhật tài khoản
    Route::get('/admin/edit', 'edit')->name('admin.edit');
    Route::post('/admin/update', 'update')->name('admin.update');

    Route::Resource('categories', CategoryController::class);
    Route::Resource('products', ProductController::class);
    Route::Resource('colors', ColorController::class);
    Route::Resource('sizes', SizeController::class);
});

// Route cho User
Route::controller(UserController::class)->middleware(['user'])->group(function () {
    Route::get('/user/dashboard', 'user')->name('user.dashboard');
    // Đổi mật khẩu
    Route::get('/user/change-password', 'changepass')->name('user.changepass.form');
    Route::post('/user/change-password', 'changepass_')->name('user.password.change');
    // Cập nhật tài khoản
    Route::get('/user/edit', 'edit')->name('user.edit');
    Route::post('/user/update', 'update')->name('user.update');
    //địa chỉ

});

// Route cho client
Route::controller(ClientController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::get('/shop', 'shop')->name('shop');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
});
