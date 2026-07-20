@extends('layouts.app')
@section('title', 'Masuk Akun - LPK Karier Sukses')

@section('content')
<div class="py-16 bg-lpk-bg flex items-center justify-center min-h-[80vh] px-4">
    <div class="max-w-md w-full bg-lpk-mint p-8 sm:p-10 rounded-3xl border border-lpk-teal/15 shadow-xl space-y-6">
        
        <div class="text-center space-y-2">
            <div class="w-12 h-12 bg-lpk-teal rounded-2xl mx-auto flex items-center justify-center text-lpk-bg font-extrabold text-2xl shadow-md">L</div>
            <h1 class="text-2xl font-extrabold text-lpk-teal tracking-tight">Selamat Datang Kembali</h1>
            <p class="text-xs text-lpk-charcoal/70 font-medium">Masuk ke akunmu untuk melanjutkan progres belajar.</p>
        </div>

        <!-- Pesan Error Login -->
        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-2xl text-xs font-bold border border-red-200">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-lpk-charcoal mb-1">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="contoh: budi@lpk.com" 
                       class="w-full px-4 py-3 bg-lpk-bg text-lpk-charcoal text-sm font-medium rounded-2xl border border-lpk-teal/20 focus:outline-none focus:border-lpk-teal">
            </div>

            <div>
                <div class="flex justify-between items-center mb-1">
                    <label class="block text-xs font-bold text-lpk-charcoal">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[11px] font-bold text-lpk-teal hover:underline">Lupa password?</a>
                    @endif
                </div>
                <input type="password" name="password" required placeholder="••••••••" 
                       class="w-full px-4 py-3 bg-lpk-bg text-lpk-charcoal text-sm font-medium rounded-2xl border border-lpk-teal/20 focus:outline-none focus:border-lpk-teal">
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-lpk-teal hover:bg-lpk-charcoal text-lpk-bg font-extrabold py-3.5 rounded-2xl text-sm transition-all shadow-md transform active:scale-[0.98]">
                    Masuk Sekarang →
                </button>
            </div>
        </form>

        <p class="text-center text-xs text-lpk-charcoal/80 font-medium pt-4 border-t border-lpk-teal/10">
            Belum punya akun peserta? <a href="{{ route('register') }}" class="font-extrabold text-lpk-teal hover:underline">Daftar di sini</a>
        </p>

    </div>
</div>
@endsection