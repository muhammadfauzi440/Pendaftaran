<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login_form'])->name('login');
Route::post('/login', [AuthController::class, 'login_proses']);

Route::get('/register', [AuthController::class, 'register_form'])->name('register');
Route::post('/register', [AuthController::class, 'register_proses']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/cek-status/{nim}', [PendaftaranController::class, 'cekStatusPublic']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/admin/users', [ProfileController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{id}', [ProfileController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index_admin'])->name('admin.dashboard');

    Route::get('/admin/kelola-pendaftaran', [AdminController::class, 'index'])->name('admin.pendaftaran.index');
    Route::get('/admin/kelola-pendaftaran/{id}', [AdminController::class, 'show'])->name('admin.pendaftaran.show');
    Route::post('/admin/kelola-pendaftaran/{id}/update-status', [AdminController::class, 'updateStatus'])->name('admin.pendaftaran.updateStatus');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'index_user'])->name('user.dashboard');
    Route::get('/user/daftar', [PendaftaranController::class, 'index'])->name('user.daftar');
    Route::post('/user/daftar/submit', [PendaftaranController::class, 'storeOrUpdate'])->name('user.daftar.submit');
});