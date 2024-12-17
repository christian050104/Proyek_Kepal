<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Member\CartController;
use App\Http\Controllers\Member\TransactionController as MemberTransactionController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Autentikasi Umum (Login, Register)
|--------------------------------------------------------------------------
*/
// Registrasi dengan OTP
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('register/verify', [RegisterController::class, 'showVerifyOtpForm'])->name('register.verify');
Route::post('register/verify', [RegisterController::class, 'verifyOtp']);

// Auth Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard Admin
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard')
    ->middleware(['auth']);


// Home untuk Member
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth']);

/*
|--------------------------------------------------------------------------
| Rute Khusus Member
|--------------------------------------------------------------------------
*/
Route::prefix('member')->name('member.')->middleware(['auth', 'role:member'])->group(function () {
    // Keranjang Belanja
    Route::get('cart', [CartController::class, 'showCart'])->name('cart.index');
    Route::get('cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('cart/remove/{id}', [CartController::class, 'removeCartItem'])->name('cart.remove');

    // Checkout dan Transaksi
    Route::post('checkout', [MemberTransactionController::class, 'checkout'])->name('checkout');
    Route::get('transactions/{id}', [MemberTransactionController::class, 'show'])->name('transactions.show');
});

/*
|--------------------------------------------------------------------------
| Rute Khusus Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard Admin
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Manajemen Produk
    Route::resource('products', AdminProductController::class);

    // Manajemen Transaksi
    Route::get('transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/{id}', [AdminTransactionController::class, 'show'])->name('transactions.show');
    Route::post('transactions/{id}/status/{status}', [AdminTransactionController::class, 'updateStatus'])->name('transactions.updateStatus');
});

/*
|--------------------------------------------------------------------------
| Rute Khusus Admin Login
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'adminLogin']);
