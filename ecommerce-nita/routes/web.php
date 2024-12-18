<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Member\CartController;
use App\Http\Controllers\Member\TransactionController as MemberTransactionController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Member\MemberProductController;
use App\Http\Controllers\Member\TransactionController;
/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
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
      Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
      Route::post('/cart/{id}/add', [CartController::class, 'add'])->name('cart.add');
      Route::post('/cart/{id}/decrement', [CartController::class, 'decrement'])->name('cart.decrement');
      Route::post('/cart/{id}/remove', [CartController::class, 'remove'])->name('cart.remove');
      Route::get('/cart/remove/{id}', [CartController::class, 'removeCartItem'])->name('cart.removeItem');

      Route::get('/checkout', [TransactionController::class, 'checkoutForm'])->name('checkout.form');
      Route::post('/checkout/process', [TransactionController::class, 'processCheckout'])->name('checkout.process');
      Route::get('/transactions/{encryptedId}', [TransactionController::class, 'showTransaction'])->name('transactions.show');
  
    Route::get('products', [MemberProductController::class, 'index'])->name('products.index');
    Route::get('products/{id}', [MemberProductController::class, 'show'])->name('products.show');

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

});

/*
|--------------------------------------------------------------------------
| Rute Khusus Admin Login
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'adminLogin']);
