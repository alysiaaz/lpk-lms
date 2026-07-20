<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Htpp\Controllers\Peserta\DashboardController as PesertaDashboard;

// Publik
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/tentang', [BerandaController::class, 'tentang'])->name('tentang');
Route::get('/kursus', [KursusController::class, 'index'])->name('kursus.index');
Route::get('/kursus/{slug}', [KursusController::class, 'show'])->name('kursus.show');

// penghubung dashboard
Route::get('/dashboard', function() {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

// login peserta (setelah login)
Route::middleware(['auth'])->prefix('peserta')->group(function() {
    Route::get('/dashboard', [PesertaDashboard::class, 'index'])->name('peserta.dashboard');
    Route::get('/kurus-saya', [PesertaDashboard::class, 'kursusSaya'])->name('peserta.kursus');
});

// admin (wajib login dengan role admin)
Route::middleware(['auth'])->prefix('admin')->group(function() {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
});


require __DIR__.'/auth.php';
