<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MoviesController;
use App\Http\Controllers\Admin\CinemasController;
use App\Http\Controllers\Admin\StudiosController;
use App\Http\Controllers\Admin\SchedulesController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Movie routes
Route::get('/movie/{id}', [MovieController::class, 'show'])->name('movie.show');

// Booking routes
Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{uniqueCode}', [BookingController::class, 'success'])->name('booking.success');

// Auth routes (hidden)
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin routes (protected)
Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->group(function () {
    // Dashboard & QR Scanner
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/qr-scanner', [AdminController::class, 'qrScanner'])->name('admin.qr-scanner');
    Route::post('/scan-booking', [AdminController::class, 'scanBooking'])->name('admin.scan-booking');
    Route::post('/update-booking-status', [AdminController::class, 'updateBookingStatus'])->name('admin.update-booking-status');
    
    // Movies CRUD
    Route::resource('movies', MoviesController::class)->names([
        'index' => 'admin.movies.index',
        'create' => 'admin.movies.create',
        'store' => 'admin.movies.store',
        'show' => 'admin.movies.show',
        'edit' => 'admin.movies.edit',
        'update' => 'admin.movies.update',
        'destroy' => 'admin.movies.destroy',
    ]);
    
    // Cinemas CRUD
    Route::resource('cinemas', CinemasController::class)->names([
        'index' => 'admin.cinemas.index',
        'create' => 'admin.cinemas.create',
        'store' => 'admin.cinemas.store',
        'show' => 'admin.cinemas.show',
        'edit' => 'admin.cinemas.edit',
        'update' => 'admin.cinemas.update',
        'destroy' => 'admin.cinemas.destroy',
    ]);
    
    // Studios CRUD
    Route::resource('studios', StudiosController::class)->names([
        'index' => 'admin.studios.index',
        'create' => 'admin.studios.create',
        'store' => 'admin.studios.store',
        'show' => 'admin.studios.show',
        'edit' => 'admin.studios.edit',
        'update' => 'admin.studios.update',
        'destroy' => 'admin.studios.destroy',
    ]);
    
    // Schedules CRUD
    Route::resource('schedules', SchedulesController::class)->names([
        'index' => 'admin.schedules.index',
        'create' => 'admin.schedules.create',
        'store' => 'admin.schedules.store',
        'show' => 'admin.schedules.show',
        'edit' => 'admin.schedules.edit',
        'update' => 'admin.schedules.update',
        'destroy' => 'admin.schedules.destroy',
    ]);
    
    // Bookings Management
    Route::resource('bookings', BookingsController::class)->except(['create', 'store', 'edit'])->names([
        'index' => 'admin.bookings.index',
        'show' => 'admin.bookings.show',
        'update' => 'admin.bookings.update',
        'destroy' => 'admin.bookings.destroy',
    ]);
    
    // Additional booking actions
    Route::patch('/bookings/{booking}/status', [BookingsController::class, 'updateStatus'])->name('admin.bookings.update-status');
    Route::patch('/bookings/{booking}/cancel', [BookingsController::class, 'cancel'])->name('admin.bookings.cancel');
    Route::patch('/bookings/{booking}/mark-paid', [BookingsController::class, 'markAsPaid'])->name('admin.bookings.mark-paid');
});