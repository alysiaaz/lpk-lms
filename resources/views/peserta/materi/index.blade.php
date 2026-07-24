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
                        <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-lpk-teal/10" stroke-width="4"></circle>
                        <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-lpk-teal transition-all duration-1000 ease-in-out" stroke-width="4" stroke-dasharray="100" stroke-dashoffset="{{ 100 - $persentase }}" stroke-linecap="round"></circle>
                    </svg>
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

        <div class="space-y-6">
            
            <!-- KARTU PRE-TEST -->
            @php
                $preTest = $kursus->ujians->where('tipe', 'pre-test')->first();
            @endphp
            @if($preTest)
                <div class="bg-gradient-to-r from-lpk-gold/20 to-lpk-mint/40 rounded-3xl border-2 border-lpk-gold/60 p-6 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-4 text-center sm:text-left">
                        <span class="w-12 h-12 rounded-2xl bg-lpk-gold/30 text-lpk-charcoal flex items-center justify-center text-2xl shrink-0">📝</span>
                        <div>
                            <span class="text-xs font-extrabold text-lpk-charcoal uppercase tracking-wider">Tahap Awal</span>
                            <h2 class="text-lg font-extrabold text-lpk-teal">{{ $preTest->judul }}</h2>
                            <p class="text-xs text-lpk-charcoal/70">Kerjakan ujian awal ini untuk mengukur kemampuan dasarmu.</p>
                        </div>
                    </div>
                    <a href="{{ route('peserta.ujian.show', $preTest->id) }}" class="w-full sm:w-auto text-center bg-lpk-teal hover:bg-opacity-90 text-white font-extrabold text-sm px-6 py-3.5 rounded-full shadow transition shrink-0">
                        Kerjakan Pre-Test &rarr;
                    </a>
                </div>
            @endif

            <!-- DAFTAR MODUL & MATERI -->
            @if($kursus->moduls->isEmpty())
                <div class="bg-lpk-mint rounded-3xl border border-lpk-teal/10 p-10 text-center">
                    <p class="text-sm text-lpk-charcoal/70 font-medium">Materi untuk kursus ini belum tersedia. Silakan cek kembali nanti.</p>
                </div>
            @else
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
                                        $isCompleted = auth()->user()->materiSelesai->contains($materi->id);
                                    @endphp

                                    <li class="group">
                                        <a href="{{ route('peserta.materi.show', $materi->id) }}" class="flex items-center justify-between px-6 py-4 hover:bg-lpk-mint/40 transition">
                                            <div class="flex items-center gap-4">
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
            @endif

            <!-- KARTU POST-TEST -->
            @php
                $postTest = $kursus->ujians->where('tipe', 'post-test')->first();
            @endphp
            @if($postTest)
                <div class="bg-white rounded-3xl border-2 {{ $persentase == 100 ? 'border-lpk-teal shadow-md bg-lpk-mint/10' : 'border-gray-200 opacity-75' }} p-6 flex flex-col sm:flex-row items-center justify-between gap-4 transition-all">
                    <div class="flex items-center gap-4 text-center sm:text-left">
                        <span class="w-12 h-12 rounded-2xl {{ $persentase == 100 ? 'bg-lpk-teal text-white' : 'bg-gray-200 text-gray-400' }} flex items-center justify-center text-2xl shrink-0">🎓</span>
                        <div>
                            <span class="text-xs font-extrabold {{ $persentase == 100 ? 'text-lpk-teal' : 'text-gray-400' }} uppercase tracking-wider">Tahap Akhir / Evaluasi</span>
                            <h2 class="text-lg font-extrabold {{ $persentase == 100 ? 'text-lpk-teal' : 'text-gray-500' }}">{{ $postTest->judul }}</h2>
                            <p class="text-xs {{ $persentase == 100 ? 'text-lpk-charcoal/70' : 'text-gray-400' }}">
                                {{ $persentase == 100 ? 'Kerjakan ujian akhir ini untuk mengevaluasi pemahamanmu.' : 'Selesaikan seluruh 100% materi terlebih dahulu untuk membuka ujian ini.' }}
                            </p>
                        </div>
                    </div>
                    
                    @if($persentase == 100)
                        <a href="{{ route('peserta.ujian.show', $postTest->id) }}" class="w-full sm:w-auto text-center bg-lpk-gold hover:bg-opacity-90 text-lpk-charcoal font-extrabold text-sm px-6 py-3.5 rounded-full shadow transition shrink-0">
                            Kerjakan Post-Test &rarr;
                        </a>
                    @else
                        <button disabled class="w-full sm:w-auto text-center bg-gray-200 text-gray-400 font-bold text-sm px-6 py-3.5 rounded-full cursor-not-allowed shrink-0">
                            🔒 Terkunci
                        </button>
                    @endif
                </div>
            @endif

            <!-- TOMBOL AKSES SERTIFIKAT KELULUSAN (Menggunakan variabel dari Controller) -->
            @if(isset($postTest) && isset($sudahLulusPostTest) && $sudahLulusPostTest)
                <div class="bg-gradient-to-r from-lpk-gold/30 to-lpk-mint/50 rounded-3xl border-2 border-lpk-gold p-8 text-center space-y-4 shadow-md">
                    <div class="w-16 h-16 bg-lpk-gold text-white rounded-2xl flex items-center justify-center text-3xl mx-auto shadow-sm">
                        🏆
                    </div>
                    <div class="space-y-1">
                        <h3 class="text-xl font-extrabold text-lpk-teal">Selamat! Anda Telah Menyelesaikan Kursus Ini</h3>
                        <p class="text-sm text-lpk-charcoal/70 max-w-lg mx-auto">Sertifikat kelulusan resmi Anda sudah diterbitkan dan siap untuk diunduh atau dicetak.</p>
                    </div>
                    <div class="pt-2">
                        <a href="{{ route('peserta.sertifikat.show', $kursus->id) }}" target="_blank" class="inline-flex items-center gap-2 bg-lpk-teal hover:bg-opacity-90 text-white font-extrabold px-8 py-4 rounded-full shadow-lg transition text-sm">
                            <span>🖨️</span> Lihat & Cetak Sertifikat Kelulusan
                        </a>
                    </div>
                </div>
            @endif

        </div>

    </div>
</div>
@endsection