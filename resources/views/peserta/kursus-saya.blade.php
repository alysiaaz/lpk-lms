@extends('layouts.app')
@section('title', 'Kursus Saya - LPK Karier Sukses')

@section('content')
<div class="py-12 bg-lpk-bg min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <div class="space-y-2">
            <h1 class="text-3xl font-extrabold text-lpk-teal">Kursus Saya</h1>
            <p class="text-sm text-lpk-charcoal/70">Daftar program pelatihan yang sudah kamu ikuti.</p>
        </div>

        @if(session('success'))
            <div class="bg-lpk-mint border border-lpk-teal/20 text-lpk-teal text-sm font-semibold px-5 py-3 rounded-2xl">
                {{ session('success') }}
            </div>
        @endif
        @if(session('info'))
            <div class="bg-lpk-mint border border-lpk-teal/20 text-lpk-teal text-sm font-semibold px-5 py-3 rounded-2xl">
                {{ session('info') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 text-sm font-semibold px-5 py-3 rounded-2xl">
                {{ session('error') }}
            </div>
        @endif

        @forelse($kursusSaya as $kursus)
            @php
                // Menghitung persentase progres untuk masing-masing kursus
                // 1. Ambil semua ID materi dari kursus ini
                $materiIds = $kursus->moduls->flatMap->materis->pluck('id');
                $totalMateri = $materiIds->count();

                // 2. Cek materi mana yang sudah diselesaikan user
                $materiSelesaiCount = auth()->user()->materiSelesai->whereIn('id', $materiIds)->count();

                // 3. Hitung persentase
                $persentase = $totalMateri > 0 ? round(($materiSelesaiCount / $totalMateri) * 100) : 0;
            @endphp

            <div class="bg-white rounded-3xl border border-lpk-teal/10 p-6 shadow-sm flex flex-col md:flex-row justify-between gap-6 hover:shadow-md transition">
                <!-- Info Kursus & Progress Bar -->
                <div class="space-y-3 flex-1">
                    <div class="flex items-center gap-2">
                        <span class="inline-block bg-lpk-mint text-lpk-teal font-bold text-xs px-3 py-1 rounded-full uppercase tracking-wider">
                            {{ $kursus->kategori->nama ?? 'Umum' }}
                        </span>
                        
                        <!-- Label Lulus jika 100% -->
                        @if($persentase == 100)
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 font-bold text-xs px-3 py-1 rounded-full uppercase tracking-wider border border-green-300">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                Selesai
                            </span>
                        @endif
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-extrabold text-lpk-teal">{{ $kursus->judul }}</h3>
                        <p class="text-sm text-lpk-charcoal/70 line-clamp-1">{{ $kursus->deskripsi }}</p>
                    </div>
                    
                    <!-- Progress Bar Area -->
                    <div class="max-w-md pt-2">
                        <div class="flex justify-between text-xs font-bold mb-1">
                            <span class="text-lpk-teal">Progres Belajar</span>
                            <span class="{{ $persentase == 100 ? 'text-green-600' : 'text-lpk-teal' }}">{{ $persentase }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="h-2 rounded-full transition-all duration-1000 ease-in-out {{ $persentase == 100 ? 'bg-green-500' : 'bg-lpk-teal' }}" style="width: {{ $persentase }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">{{ $materiSelesaiCount }} dari {{ $totalMateri }} materi diselesaikan</p>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="shrink-0 flex flex-col sm:flex-row items-center justify-center gap-2 mt-4 md:mt-0 border-t md:border-t-0 md:border-l border-gray-100 pt-4 md:pt-0 md:pl-6">
                    @if($kursus->pivot->status === 'aktif')
                        <!-- Ubah teks tombol jika sudah selesai -->
                        <a href="{{ route('peserta.materi.index', $kursus->id) }}" class="w-full sm:w-auto text-center bg-lpk-gold hover:bg-opacity-90 text-lpk-charcoal text-xs font-extrabold px-6 py-3 rounded-full shadow-sm transition-all">
                            {{ $persentase == 100 ? 'Lihat Kembali' : 'Lanjut Belajar' }}
                        </a>
                    @endif
                    <a href="{{ url('/kursus/' . $kursus->slug) }}" class="w-full sm:w-auto text-center bg-lpk-teal hover:bg-lpk-charcoal text-lpk-bg text-xs font-extrabold px-6 py-3 rounded-full shadow-sm transition-all">
                        Info Kursus
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-lpk-mint rounded-3xl border border-lpk-teal/10 p-10 text-center space-y-4">
                <p class="text-sm text-lpk-charcoal/70 font-medium">Kamu belum mendaftar kursus apa pun.</p>
                <a href="{{ url('/kursus') }}" class="inline-block bg-lpk-gold hover:bg-opacity-90 text-lpk-charcoal font-extrabold text-sm px-6 py-3 rounded-full shadow-sm transition-all">
                    Jelajahi Katalog Kursus
                </a>
            </div>
        @endforelse

    </div>
</div>
@endsection