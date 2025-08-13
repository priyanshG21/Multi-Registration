<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomerRegisterController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

// Registration
Route::middleware('guest')->group(function () {
    // Registration
    Route::get('/register/customer', [CustomerRegisterController::class, 'showForm'])->name('register.customer.form');
    Route::post('/register/customer', [CustomerRegisterController::class, 'register'])->name('register.customer');

    Route::get('/register/admin', [AdminRegisterController::class, 'showForm'])->name('register.admin.form');
    Route::post('/register/admin', [AdminRegisterController::class, 'register'])->name('register.admin');

    // Verification (only accessible right after registration)
    Route::middleware('verify.in.progress')->group(function () {
        Route::get('/verify', [VerificationController::class, 'showForm'])->name('verification.form');
        Route::post('/verify', [VerificationController::class, 'verify'])->name('verification.verify');
    });

    // Admin login
    Route::get('/admin/login', [AdminLoginController::class, 'showForm'])->name('login.admin.form');
    Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('login.admin');
});

// Admin dashboard placeholder (protected)
Route::get('/admin/dashboard', function () {
    return view('dashboards.admin');
})->middleware('auth')->name('admin.dashboard');

// Logout (POST for CSRF protection)
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login.admin.form');
})->middleware('auth')->name('logout');
