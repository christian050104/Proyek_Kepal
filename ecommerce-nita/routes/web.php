<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;



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
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'loginWithOtp'])->name('login.otp');
Route::post('/login/otp', [LoginController::class, 'verifyOtp'])->name('login.otp');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('register/verify', [RegisterController::class, 'showVerifyOtpForm'])->name('register.verify');
Route::post('register/verify', [RegisterController::class, 'verifyOtp']);
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
