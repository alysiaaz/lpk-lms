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

    // Materi belajar (khusus peserta yang sudah enroll di kursus terkait)
    Route::get('/kursus/{kursus}/materi', [App\Http\Controllers\Peserta\MateriController::class, 'index'])->name('peserta.materi.index');
    Route::get('/materi/{materi}', [App\Http\Controllers\Peserta\MateriController::class, 'show'])->name('peserta.materi.show');
});

// Profil akun (bisa diakses admin maupun peserta yang sudah login)
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

// pendaftaran (enroll) peserta ke sebuah kursus
Route::post('/kursus/{kursus:slug}/daftar', [EnrollmentController::class, 'store'])
    ->middleware(['auth'])
    ->name('enroll.store');

// admin (wajib login dengan role admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function() {
    
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('kategori', App\Http\Controllers\Admin\KategoriController::class);
    Route::resource('kursus', App\Http\Controllers\Admin\KursusController::class);
    Route::resource('vouchers', VoucherController::class);
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
    
    // Rute Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    
    // Rute Enrollments
    Route::get('/enrollments', [App\Http\Controllers\Admin\EnrollmentController::class, 'index'])->name('enrollment.index');
});


require __DIR__.'/auth.php';