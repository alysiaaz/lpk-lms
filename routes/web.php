<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Peserta\DashboardController as PesertaDashboard;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;

// RUTE PUBLIK
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/kursus', [KursusController::class, 'index'])->name('kursus.index');
Route::get('/kursus/{slug}', [KursusController::class, 'show'])->name('kursus.show');

Route::get('/tentang', function() {
    return view('publik.tentang');
})->name('tentang');

// Penghubung Dashboard (Cek role user saat login)
Route::get('/dashboard', function() {
    $role = auth()->user()->role;
    // Admin dan Assessor masuk ke dasbor admin
    if ($role === 'admin' || $role === 'assessor') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('peserta.dashboard');
})->middleware(['auth'])->name('dashboard');


// RUTE PESERTA (Wajib Login)
Route::middleware(['auth'])->prefix('peserta')->group(function() {
    Route::get('/dashboard', [PesertaDashboard::class, 'index'])->name('peserta.dashboard');
    Route::get('/kursus-saya', [PesertaDashboard::class, 'kursusSaya'])->name('peserta.kursus');

    // Materi belajar
    Route::get('/kursus/{kursus}/materi', [App\Http\Controllers\Peserta\MateriController::class, 'index'])->name('peserta.materi.index');
    Route::get('/materi/{materi}', [App\Http\Controllers\Peserta\MateriController::class, 'show'])->name('peserta.materi.show');
    Route::post('/materi/{materi}/progress', [App\Http\Controllers\Peserta\MateriController::class, 'toggleProgress'])->name('peserta.materi.progress');

    // Ujian (Pre-test & Post-test)
    Route::get('/ujian/{ujian}', [App\Http\Controllers\Peserta\UjianController::class, 'show'])->name('peserta.ujian.show');
    Route::post('/ujian/{ujian}/submit', [App\Http\Controllers\Peserta\UjianController::class, 'submit'])->name('peserta.ujian.submit');
    
    // Sertifikat Kelulusan
    Route::get('/kursus/{kursus}/sertifikat', [App\Http\Controllers\Peserta\SertifikatController::class, 'show'])->name('peserta.sertifikat.show');
});


// RUTE PROFIL & TRANSAKSI (Bisa diakses Admin, Assessor, & Peserta)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'destroyAvatar'])->name('profile.avatar.destroy');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/kursus/{kursus:slug}/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/kursus/{kursus:slug}/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/checkout/voucher', [CheckoutController::class, 'applyVoucher'])->name('checkout.voucher.apply');
    Route::delete('/checkout/voucher', [CheckoutController::class, 'removeVoucher'])->name('checkout.voucher.remove');

    Route::get('/order/{order}/pembayaran', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/order/{order}/konfirmasi', [PaymentController::class, 'confirm'])->name('payment.confirm');
});

// Pendaftaran (enroll) peserta ke sebuah kursus
Route::post('/kursus/{kursus:slug}/daftar', [EnrollmentController::class, 'store'])
    ->middleware(['auth'])
    ->name('enroll.store');


// PANEL KELOLA (Bisa diakses oleh ADMIN dan ASSESSOR)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function() {
    
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('kategori', App\Http\Controllers\Admin\KategoriController::class);
    Route::resource('kursus', App\Http\Controllers\Admin\KursusController::class);
    
    // Kelola Modul & Materi
    Route::prefix('kursus/{kursus}/modul')->name('kursus.modul.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ModulController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\ModulController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\ModulController::class, 'store'])->name('store');
        Route::get('/{modul}/edit', [App\Http\Controllers\Admin\ModulController::class, 'edit'])->name('edit');
        Route::put('/{modul}', [App\Http\Controllers\Admin\ModulController::class, 'update'])->name('update');
        Route::delete('/{modul}', [App\Http\Controllers\Admin\ModulController::class, 'destroy'])->name('destroy');

        Route::prefix('{modul}/materi')->name('materi.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\MateriController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\MateriController::class, 'create'])->name('create');
            Route::post('/', [App\Http\Controllers\Admin\MateriController::class, 'store'])->name('store');
            Route::get('/{materi}/edit', [App\Http\Controllers\Admin\MateriController::class, 'edit'])->name('edit');
            Route::put('/{materi}', [App\Http\Controllers\Admin\MateriController::class, 'update'])->name('update');
            Route::delete('/{materi}', [App\Http\Controllers\Admin\MateriController::class, 'destroy'])->name('destroy');   
        });
    });

    // Kelola Ujian (Pre-test & Post-test) & Soal
    Route::prefix('kursus/{kursus}/ujian')->name('kursus.ujian.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\UjianController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\UjianController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\UjianController::class, 'store'])->name('store');
        Route::get('/{ujian}/edit', [App\Http\Controllers\Admin\UjianController::class, 'edit'])->name('edit');
        Route::put('/{ujian}', [App\Http\Controllers\Admin\UjianController::class, 'update'])->name('update');
        Route::delete('/{ujian}', [App\Http\Controllers\Admin\UjianController::class, 'destroy'])->name('destroy');

        // Kelola Soal di dalam Ujian
        Route::prefix('{ujian}/soal')->name('soal.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\SoalController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\SoalController::class, 'create'])->name('create');
            Route::post('/', [App\Http\Controllers\Admin\SoalController::class, 'store'])->name('store');
            Route::get('/{soal}/edit', [App\Http\Controllers\Admin\SoalController::class, 'edit'])->name('edit');
            Route::put('/{soal}', [App\Http\Controllers\Admin\SoalController::class, 'update'])->name('update');
            Route::delete('/{soal}', [App\Http\Controllers\Admin\SoalController::class, 'destroy'])->name('destroy');
        });
    });
    
    // Rute Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    
    // KHUSUS ADMIN MURNI (Assessor tidak mengakses ini)
   Route::middleware([App\Http\Middleware\EnsureOnlyAdmin::class])->group(function() {
        Route::resource('vouchers', VoucherController::class);
        Route::get('/enrollments', [App\Http\Controllers\Admin\EnrollmentController::class, 'index'])->name('enrollment.index');
    });
});

require __DIR__.'/auth.php';