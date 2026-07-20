@extends('layouts.app')
@section('title', 'Daftar Akun Peserta - LPK Karier Sukses')

@section('content')
<div class="py-16 bg-lpk-bg flex items-center justify-center min-h-[80vh] px-4">
    <div class="max-w-md w-full bg-lpk-mint p-8 sm:p-10 rounded-3xl border border-lpk-teal/15 shadow-xl space-y-6">
        
        <div class="text-center space-y-2">
            <span class="bg-lpk-gold text-lpk-charcoal text-[10px] font-extrabold px-3 py-1 rounded-full uppercase">Pendaftaran Baru</span>
            <h1 class="text-2xl font-extrabold text-lpk-teal tracking-tight">Mulai Kariermu Hari Ini</h1>
            <p class="text-xs text-lpk-charcoal/70 font-medium">Buat akun gratis untuk mengakses seluruh katalog program.</p>
        </div>

        <!-- Pesan Error Register -->
        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-2xl text-xs font-bold border border-red-200 space-y-1">
                @foreach($errors->all() as $error)
                    <p>● {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-lpk-charcoal mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama sesuai KTP/Ijazah" 
                       class="w-full px-4 py-3 bg-lpk-bg text-lpk-charcoal text-sm font-medium rounded-2xl border border-lpk-teal/20 focus:outline-none focus:border-lpk-teal">
            </div>

            <div>
                <label class="block text-xs font-bold text-lpk-charcoal mb-1">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@contoh.com" 
                       class="w-full px-4 py-3 bg-lpk-bg text-lpk-charcoal text-sm font-medium rounded-2xl border border-lpk-teal/20 focus:outline-none focus:border-lpk-teal">
            </div>

            <div>
                <label class="block text-xs font-bold text-lpk-charcoal mb-1">Password</label>
                <input type="password" name="password" required placeholder="Minimal 8 karakter" 
                       class="w-full px-4 py-3 bg-lpk-bg text-lpk-charcoal text-sm font-medium rounded-2xl border border-lpk-teal/20 focus:outline-none focus:border-lpk-teal">
            </div>

            <div>
                <label class="block text-xs font-bold text-lpk-charcoal mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required placeholder="Ketik ulang password" 
                       class="w-full px-4 py-3 bg-lpk-bg text-lpk-charcoal text-sm font-medium rounded-2xl border border-lpk-teal/20 focus:outline-none focus:border-lpk-teal">
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-lpk-gold hover:bg-opacity-90 text-lpk-charcoal font-extrabold py-3.5 rounded-2xl text-sm transition-all shadow-md transform active:scale-[0.98]">
                    Buat Akun Peserta
                </button>
            </div>
        </form>

        <p class="text-center text-xs text-lpk-charcoal/80 font-medium pt-4 border-t border-lpk-teal/10">
            Sudah memiliki akun? <a href="{{ route('login') }}" class="font-extrabold text-lpk-teal hover:underline">Masuk di sini</a>
        </p>

    </div>
</div>
@endsection