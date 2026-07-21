<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Peserta\DashboardController as PesertaDashboard;
use App\Http\Controllers\EnrollmentController;

// Publik
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/kursus', [KursusController::class, 'index'])->name('kursus.index');
Route::get('/kursus/{slug}', [KursusController::class, 'show'])->name('kursus.show');

Route::get('/tentang', function() {
    return view('publik.tentang');
})->name('tentang');

// penghubung dashboard
Route::get('/dashboard', function() {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('peserta.dashboard');
})->middleware(['auth'])->name('dashboard');

// login peserta (setelah login)
Route::middleware(['auth'])->prefix('peserta')->group(function() {
    Route::get('/dashboard', [PesertaDashboard::class, 'index'])->name('peserta.dashboard');
    Route::get('/kursus-saya', [PesertaDashboard::class, 'kursusSaya'])->name('peserta.kursus');
});

// pendaftaran (enroll) peserta ke sebuah kursus
Route::post('/kursus/{kursus:slug}/daftar', [EnrollmentController::class, 'store'])
    ->middleware(['auth'])
    ->name('enroll.store');

// admin (wajib login dengan role admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function() {
    
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('kategori', App\Http\Controllers\Admin\KategoriController::class);
    Route::resource('kursus', App\Http\Controllers\Admin\KursusController::class);
    Route::get('/kursus/{kursus}/modul', [App\Http\Controllers\Admin\ModulController::class, 'index'])->name('kursus.modul.index');
    
    // Rute Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    
    // Rute Enrollments
    Route::get('/enrollments', [App\Http\Controllers\Admin\EnrollmentController::class, 'index'])->name('enrollment.index');
});


require __DIR__.'/auth.php';