@extends('layouts.app')
@section('title', $materi->judul_materi . ' - ' . $kursus->judul)

@section('content')
<div class="py-12 bg-lpk-bg min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="space-y-1">
            <a href="{{ route('peserta.materi.index', $kursus->id) }}" class="text-sm font-bold text-lpk-teal hover:underline">&larr; Kembali ke Daftar Materi</a>
            <p class="text-xs text-lpk-charcoal/60 font-bold uppercase tracking-wider">{{ $kursus->judul }} &middot; {{ $materi->modul->judul_modul }}</p>
            <h1 class="text-2xl font-extrabold text-lpk-teal">{{ $materi->judul_materi }}</h1>
        </div>

        <div class="bg-white rounded-3xl border border-lpk-teal/10 shadow-sm overflow-hidden">
            @if($materi->tipe === 'pdf')
                @if($materi->fileUrl())
                    <iframe src="{{ $materi->fileUrl() }}" class="w-full" style="height: 75vh;" title="{{ $materi->judul_materi }}"></iframe>
                    <div class="px-6 py-4 border-t border-lpk-teal/10 flex justify-end">
                        <a href="{{ $materi->fileUrl() }}" target="_blank" download class="inline-flex items-center gap-2 bg-lpk-teal hover:bg-lpk-charcoal text-lpk-bg text-xs font-extrabold px-5 py-2.5 rounded-full transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3"/></svg>
                            Unduh PDF
                        </a>
                    </div>
                @else
                    <p class="px-6 py-10 text-center text-sm text-lpk-charcoal/60">File PDF belum tersedia untuk materi ini.</p>
                @endif
            @else
                @if($materi->isEmbedVideo())
                    <div class="aspect-video w-full bg-black">
                        <iframe src="{{ $materi->embedUrl() }}" class="w-full h-full" title="{{ $materi->judul_materi }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                @elseif($materi->videoUrl())
                    <video src="{{ $materi->videoUrl() }}" class="w-full aspect-video bg-black" controls>
                        Browser kamu tidak mendukung pemutaran video.
                    </video>
                @else
                    <p class="px-6 py-10 text-center text-sm text-lpk-charcoal/60">Video belum tersedia untuk materi ini.</p>
                @endif
            @endif
        </div>

    </div>
</div>
@endsection
