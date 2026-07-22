@extends('layouts.app')
@section('title', $kursus->judul . ' - Materi Belajar')

@section('content')
<div class="py-12 bg-lpk-bg min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- HEADER DENGAN DIAGRAM LINGKARAN -->
        <div class="bg-white rounded-3xl p-8 border border-lpk-teal/10 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="space-y-2 text-center sm:text-left">
                <a href="{{ route('peserta.kursus') }}" class="text-sm font-bold text-lpk-teal hover:underline">&larr; Kembali ke Kursus Saya</a>
                <h1 class="text-3xl font-extrabold text-lpk-teal">{{ $kursus->judul }}</h1>
                <p class="text-sm text-lpk-charcoal/70">Ikuti materi di bawah ini secara berurutan untuk menyelesaikan kursus.</p>
            </div>
            
            <!-- Circular Progress Bar -->
            <div class="flex items-center gap-4 bg-lpk-mint/30 p-4 rounded-2xl border border-lpk-teal/10">
                <div class="relative w-16 h-16 shrink-0">
                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                        <!-- Lingkaran Background -->
                        <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-lpk-teal/10" stroke-width="4"></circle>
                        <!-- Lingkaran Progress -->
                        <!-- Logika offset: 100 - persentase -->
                        <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-lpk-teal transition-all duration-1000 ease-in-out" stroke-width="4" stroke-dasharray="100" stroke-dashoffset="{{ 100 - $persentase }}" stroke-linecap="round"></circle>
                    </svg>
                    <!-- Angka Persentase di Tengah -->
                    <div class="absolute inset-0 flex items-center justify-center text-sm font-extrabold text-lpk-teal">
                        {{ $persentase }}%
                    </div>
                </div>
                <div class="text-sm">
                    <p class="font-bold text-lpk-teal">Progres Belajar</p>
                    <p class="text-lpk-charcoal/60">{{ $materiSelesai }} dari {{ $totalMateri }} materi selesai</p>
                </div>
            </div>
        </div>

        @if($kursus->moduls->isEmpty())
            <div class="bg-lpk-mint rounded-3xl border border-lpk-teal/10 p-10 text-center">
                <p class="text-sm text-lpk-charcoal/70 font-medium">Materi untuk kursus ini belum tersedia. Silakan cek kembali nanti.</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach($kursus->moduls as $modul)
                    <div class="bg-white rounded-3xl border border-lpk-teal/10 shadow-sm overflow-hidden">
                        <div class="bg-lpk-mint/60 px-6 py-4 border-b border-lpk-teal/10">
                            <span class="text-xs font-bold text-lpk-teal/70 uppercase tracking-wider">Modul {{ $loop->iteration }}</span>
                            <h2 class="text-lg font-extrabold text-lpk-teal">{{ $modul->judul_modul }}</h2>
                        </div>

                        @if($modul->materis->isEmpty())
                            <p class="px-6 py-5 text-sm text-lpk-charcoal/60">Belum ada materi di modul ini.</p>
                        @else
                            <ul class="divide-y divide-lpk-teal/10">
                                @foreach($modul->materis as $materi)
                                    @php
                                        // Mengecek apakah materi ini sudah ditandai selesai otomatis
                                        $isCompleted = auth()->user()->materiSelesai->contains($materi->id);
                                    @endphp

                                    <li class="group">
                                        <a href="{{ route('peserta.materi.show', $materi->id) }}" class="flex items-center justify-between px-6 py-4 hover:bg-lpk-mint/40 transition">
                                            <div class="flex items-center gap-4">
                                                <!-- Ikon Status Otomatis -->
                                                @if($isCompleted)
                                                    <span class="shrink-0 w-6 h-6 rounded-full bg-lpk-teal text-white flex items-center justify-center shadow-sm">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                    </span>
                                                @else
                                                    <span class="shrink-0 w-6 h-6 rounded-full border-2 border-lpk-teal/20 group-hover:border-lpk-teal/40 transition"></span>
                                                @endif
                                                
                                                <div>
                                                    <p class="font-semibold text-lpk-charcoal text-sm group-hover:text-lpk-teal transition {{ $isCompleted ? 'line-through text-lpk-charcoal/50' : '' }}">{{ $materi->judul_materi }}</p>
                                                    <p class="text-xs text-lpk-charcoal/60 uppercase font-bold tracking-wide">{{ $materi->tipe }}</p>
                                                </div>
                                            </div>

                                            <div class="flex items-center gap-3">
                                                @if($isCompleted)
                                                    <span class="text-xs font-bold text-lpk-teal bg-lpk-mint px-2 py-1 rounded-lg">Selesai</span>
                                                @endif
                                                <svg class="w-4 h-4 shrink-0 text-lpk-teal/40 group-hover:text-lpk-teal transition" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection