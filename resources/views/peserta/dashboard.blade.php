@extends('layouts.app')
@section('title', 'Ruang Belajar - LPK Karier Sukses')

@section('content')
<div class="py-12 bg-lpk-bg min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- HEADER DASBOR -->
        <div class="bg-lpk-teal text-lpk-bg p-8 sm:p-10 rounded-[2.5rem] shadow-xl flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-80 h-80 bg-lpk-gold/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="space-y-2 relative z-10">
                <span class="bg-lpk-gold text-lpk-charcoal font-extrabold text-xs px-3 py-1 rounded-full uppercase tracking-wider">Ruang Peserta</span>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Halo, {{ auth()->user()->name }}! 👋</h1>
                <p class="text-lpk-bg/80 text-sm max-w-xl font-normal">Selamat datang di panel belajarmu. Pilih program pelatihan di bawah ini untuk memulai atau melanjutkan progres keahlianmu.</p>
            </div>
            <div class="relative z-10">
                <a href="{{ url('/kursus') }}" class="inline-block bg-lpk-gold hover:bg-opacity-90 text-lpk-charcoal font-extrabold px-6 py-3.5 rounded-2xl text-sm transition-all shadow-md transform hover:-translate-y-0.5">
                    + Ambil Kursus Baru
                </a>
            </div>
        </div>

        <!-- REKOMENDASI KURSUS -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-extrabold text-lpk-teal tracking-tight">Rekomendasi Program Keahlian</h2>
                    <p class="text-xs text-lpk-charcoal/70 font-medium">Kursus dengan peluang penyaluran kerja tertinggi minggu ini.</p>
                </div>
                <a href="{{ url('/kursus') }}" class="text-xs font-bold text-lpk-teal hover:text-lpk-gold transition-colors">Lihat Katalog →</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Memanggil komponen kartu kursus --}}
                @foreach($rekomendasiKursus as $item)
                    <x-kartu-kursus :kursus="$item" />
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection