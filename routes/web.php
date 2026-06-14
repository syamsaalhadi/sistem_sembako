<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PrediksiController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Barang routes
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    // Penjualan routes
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
    Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');

    // Prediksi routes
    Route::get('/prediksi', [PrediksiController::class, 'index'])->name('prediksi.index');
    Route::post('/prediksi/hitung', [PrediksiController::class, 'hitung'])->name('prediksi.hitung');
    Route::get('/prediksi/cetak', [PrediksiController::class, 'cetak'])->name('prediksi.cetak');
    Route::get('/prediksi/export', [PrediksiController::class, 'export'])->name('prediksi.export');

    // Fuzzy routes
    Route::get('/fuzzy', [\App\Http\Controllers\FuzzyRuleController::class, 'index'])->name('fuzzy.index');

    // Laporan routes
    Route::get('/laporan', [\App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [\App\Http\Controllers\LaporanController::class, 'cetak'])->name('laporan.cetak');

    // Pengguna routes
    Route::get('/pengguna', [\App\Http\Controllers\AdminUserController::class, 'index'])->name('pengguna.index');
    Route::post('/pengguna', [\App\Http\Controllers\AdminUserController::class, 'store'])->name('pengguna.store');
    Route::put('/pengguna/{id}', [\App\Http\Controllers\AdminUserController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}', [\App\Http\Controllers\AdminUserController::class, 'destroy'])->name('pengguna.destroy');

    // Pengaturan routes
    Route::get('/pengaturan', [\App\Http\Controllers\SettingController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan', [\App\Http\Controllers\SettingController::class, 'update'])->name('pengaturan.update');
});
