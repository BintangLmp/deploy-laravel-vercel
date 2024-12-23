<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PetugasController;

// ====================================================
// Auth Routes
// ====================================================
Auth::routes(['reset' => true]);

// ====================================================
// Guest Routes
// ====================================================
Route::get('/', [GuestController::class, 'home'])->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ====================================================
// Admin Routes
// ====================================================
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('pages.admin.dashboard');

    // Laporan routes
    Route::get('/laporan', [LaporanController::class, 'index'])->name('pages.admin.laporan.index');
    Route::post('/laporan/generate', [LaporanController::class, 'laporan'])->name('pages.admin.laporan.generate');
    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('pages.admin.laporan.export');

    Route::get('/petugas', [UserController::class, 'listPetugas'])->name('pages.admin.petugas.index');
    // Pelanggan routes
    Route::get('/pelanggan', [UserController::class, 'index'])->name('pages.admin.pelanggan.index');

    // Pengaduan routes (Admin)
    Route::resource('pengaduan', PengaduanController::class)->names('admin.pengaduan');
});
// ====================================================
// Petugas Routes
// ====================================================
Route::prefix('petugas')->middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/', [PetugasController::class, 'index'])->name('petugas'); 
    Route::get('/create', [PetugasController::class, 'create'])->name('petugas.create');
    Route::post('/', [PetugasController::class, 'store'])->name('petugas.store');
    Route::delete('/{id_petugas}', [PetugasController::class, 'destroy'])->name('petugas.destroy'); 
    Route::resource('pengaduan', PengaduanController::class)->names('petugas.pengaduan');
});

// ====================================================
// Pelanggan Routes
// ====================================================
Route::prefix('pelanggan')->middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('pelanggan.index');

    // Pengaduan routes (Pelanggan)
    Route::resource('pengaduan', PengaduanController::class)
        ->only(['index', 'store', 'show'])
        ->names('pelanggan.pengaduan');
});

// ====================================================
// Rute untuk halaman utama setelah login
// ====================================================
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
