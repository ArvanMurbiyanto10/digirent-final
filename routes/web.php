<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Import semua Controller yang kita butuhkan
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// == RUTE PUBLIK ==
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // <-- INI YANG HILANG
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/syarat-ketentuan', [PageController::class, 'terms'])->name('terms.show');
Route::get('/kebijakan-privasi', [PageController::class, 'privacy'])->name('privacy.show');
Route::get('/pesanan/{booking}/sukses', [BookingController::class, 'paymentSuccess'])->name('booking.success');

// == RUTE YANG MEMBUTUHKAN LOGIN ==
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Booking
    Route::get('/sewa/{product:slug}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/sewa', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/pesanan/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::get('/pesanan/{booking}/download', [BookingController::class, 'downloadInvoice'])->name('booking.downloadInvoice');
});


// == RUTE ADMIN ==
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::patch('/bookings/{booking}/confirm', [AdminController::class, 'confirmBooking'])->name('bookings.confirm');
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
});


// File rute autentikasi bawaan dari Breeze
require __DIR__ . '/auth.php';
