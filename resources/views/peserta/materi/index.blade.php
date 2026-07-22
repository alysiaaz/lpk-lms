@extends('layouts.app')
@section('title', $kursus->judul . ' - Materi Belajar')

@section('content')
<div class="py-12 bg-lpk-bg min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <div class="space-y-2">
            <a href="{{ route('peserta.kursus') }}" class="text-sm font-bold text-lpk-teal hover:underline">&larr; Kembali ke Kursus Saya</a>
            <h1 class="text-3xl font-extrabold text-lpk-teal">{{ $kursus->judul }}</h1>
            <p class="text-sm text-lpk-charcoal/70">Ikuti materi di bawah ini secara berurutan untuk menyelesaikan kursus.</p>
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
                                    <li>
                                        <a href="{{ route('peserta.materi.show', $materi->id) }}" class="flex items-center justify-between gap-4 px-6 py-4 hover:bg-lpk-mint/40 transition">
                                            <div class="flex items-center gap-3">
                                                <span class="shrink-0 w-9 h-9 rounded-full flex items-center justify-center {{ $materi->tipe === 'pdf' ? 'bg-sky-50 text-sky-700' : 'bg-amber-50 text-amber-700' }}">
                                                    @if($materi->tipe === 'pdf')
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                    @else
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    @endif
                                                </span>
                                                <div>
                                                    <p class="font-semibold text-lpk-charcoal text-sm">{{ $materi->judul_materi }}</p>
                                                    <p class="text-xs text-lpk-charcoal/60 uppercase font-bold tracking-wide">{{ $materi->tipe }}</p>
                                                </div>
                                            </div>
                                            <svg class="w-4 h-4 text-lpk-teal shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
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
