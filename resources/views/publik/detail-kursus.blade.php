@extends('layouts.app')
@section('title', $kursus->judul . ' - LPK Karier Sukses')

@section('content')
    <!-- HEADER DETAIL KURSUS -->
    <section class="bg-lpk-teal text-lpk-bg py-16 border-b border-lpk-teal/20 relative overflow-hidden">
        <div class="absolute right-0 top-0 w-96 h-96 bg-lpk-gold/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl space-y-4">
                <div class="flex items-center space-x-3">
                    <span class="bg-lpk-gold text-lpk-charcoal font-extrabold text-xs px-3 py-1 rounded-full uppercase tracking-wider">
                        {{ $kursus->kategori->nama_kategori ?? 'Umum' }}
                    </span>
                    <span class="text-lpk-mint text-xs font-semibold">● Program Terakreditasi</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight leading-tight">{{ $kursus->judul }}</h1>
                <p class="text-lpk-bg/80 text-sm sm:text-base leading-relaxed font-normal">{{ $kursus->deskripsi }}</p>
                
                <div class="pt-4 flex flex-wrap items-center gap-6 text-xs font-semibold text-lpk-mint">
                    <span class="flex items-center"> <strong class="text-lpk-gold ml-1.5">{{ $kursus->peserta_count ?? 0 }}</strong> Siswa Terdaftar</span>
                    <span> Estimasi Waktu: <strong class="text-lpk-bg">Sesuai Kurikulum</strong></span>
                    <span> Sertifikat: <strong class="text-lpk-bg">{{ $kursus->sertifikat }}</strong></span>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTEN SILABUS & CALL TO ACTION -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-8 space-y-8">
                <!-- Deskripsi Lengkap -->
                <div class="bg-lpk-mint p-8 rounded-3xl border border-lpk-teal/10 space-y-4 shadow-sm">
                    <h3 class="text-xl font-extrabold text-lpk-teal">Tentang Program Pelatihan Ini</h3>
                    <p class="text-lpk-charcoal/80 text-sm leading-relaxed font-normal">
                        {{ $kursus->deskripsi }}
                    </p>
                </div>

                <!-- Modul Belajar (Dinamis) -->
                <div class="space-y-4">
                    <h3 class="text-xl font-extrabold text-lpk-teal">Kurikulum & Modul Belajar</h3>
                    <div class="space-y-3">
                        @forelse($kursus->moduls as $modul)
                        <div class="bg-lpk-bg p-5 rounded-2xl border border-lpk-teal/15 flex items-center justify-between font-bold text-sm text-lpk-charcoal shadow-sm">
                            <span>{{ $modul->judul_modul }}</span>
                            <span class="text-xs text-lpk-teal font-semibold">{{ $modul->durasi }}</span>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500">Belum ada modul yang ditambahkan.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Kartu Pendaftaran -->
            <div class="lg:col-span-4">
                <div class="bg-lpk-teal text-lpk-bg p-6 sm:p-8 rounded-3xl sticky top-28 shadow-xl space-y-6 border border-lpk-gold/20">
                    <div>
                        <span class="text-lpk-gold text-xs font-bold uppercase tracking-wider">Biaya Program</span>
                        <div class="text-3xl font-extrabold text-lpk-bg mt-1">Rp {{ number_format($kursus->harga, 0, ',', '.') }}</div>
                    </div>

                    <hr class="border-lpk-bg/15">

                    <div>
                        <span class="text-lpk-gold text-xs font-bold uppercase tracking-wider">Status Kelas</span>
                        <div class="text-2xl font-extrabold text-lpk-bg mt-1">{{ $kursus->status_kelas }}</div>
                        <p class="text-lpk-mint/80 text-xs mt-1">Kuota terbatas untuk menjaga kualitas mentoring.</p>
                    </div>

                    <hr class="border-lpk-bg/15">

                    <div class="space-y-3 text-xs text-lpk-bg/80 font-medium">
                        <div class="flex justify-between"><span>Metode Belajar</span><strong class="text-lpk-bg">{{ $kursus->metode_belajar }}</strong></div>
                        <div class="flex justify-between"><span>Tingkat Kesiapan</span><strong class="text-lpk-gold">{{ $kursus->tingkat_kesiapan }}</strong></div>
                        <div class="flex justify-between"><span>Sertifikat</span><strong class="text-lpk-bg">{{ $kursus->sertifikat }}</strong></div>
                    </div>

                    <div class="pt-2">
                        @guest
                            {{-- Belum login: arahkan ke halaman daftar akun dulu --}}
                            <a href="{{ route('register') }}" class="w-full block text-center bg-lpk-gold hover:bg-opacity-90 text-lpk-charcoal font-extrabold py-4 rounded-2xl text-sm transition-all shadow-md">
                                Daftar Program Sekarang
                            </a>
                        @elseif(auth()->user()->role === 'peserta')
                            @if(auth()->user()->kursuses()->where('kursus_id', $kursus->id)->exists())
                                {{-- Sudah terdaftar di kursus ini --}}
                                <a href="{{ route('peserta.kursus') }}" class="w-full block text-center bg-lpk-mint text-lpk-teal font-extrabold py-4 rounded-2xl text-sm transition-all shadow-sm">
                                    ✓ Sudah Terdaftar — Lihat Kursus Saya
                                </a>
                            @else
                                {{-- Sudah login sebagai peserta, belum daftar kursus ini: arahkan ke checkout --}}
                                <a href="{{ route('checkout.show', $kursus->slug) }}" class="w-full block text-center bg-lpk-gold hover:bg-opacity-90 text-lpk-charcoal font-extrabold py-4 rounded-2xl text-sm transition-all shadow-md">
                                    Daftar Program Sekarang
                                </a>
                            @endif
                        @else
                            {{-- Login sebagai admin: tidak perlu tombol daftar --}}
                            <p class="text-center text-xs text-lpk-mint/80 font-semibold">Masuk sebagai admin</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection