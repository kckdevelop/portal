<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminAppGalleryController;
use App\Http\Controllers\Admin\AdminGuestbookController;

// Public Landing Page & Exhibition Catalog
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/karya/{karya}', [HomeController::class, 'show'])->name('karya.show');

// Public Guestbook
Route::get('/buku-tamu', [GuestbookController::class, 'index'])->name('guestbook.index');
Route::post('/buku-tamu', [GuestbookController::class, 'store'])->name('guestbook.store');

// Fallback default auth route alias
Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/', [AdminDashboardController::class, 'index'])->name('index');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Pengaturan Logo & Identitas Website
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
        Route::delete('/settings/logo', [AdminSettingController::class, 'deleteLogo'])->name('settings.delete-logo');

        // Manajemen Karya Siswa (CRUD)
        Route::resource('karya', AdminAppGalleryController::class)->except(['show']);
        Route::post('/karya/{karya}/toggle-featured', [AdminAppGalleryController::class, 'toggleFeatured'])->name('karya.toggle-featured');

        // Moderasi Buku Tamu
        Route::get('/buku-tamu', [AdminGuestbookController::class, 'index'])->name('guestbook.index');
        Route::get('/buku-tamu/export', [AdminGuestbookController::class, 'exportCsv'])->name('guestbook.export');
        Route::post('/buku-tamu/{guestbook}/toggle-approval', [AdminGuestbookController::class, 'toggleApproval'])->name('guestbook.toggle-approval');
        Route::delete('/buku-tamu/{guestbook}', [AdminGuestbookController::class, 'destroy'])->name('guestbook.destroy');
    });
});
