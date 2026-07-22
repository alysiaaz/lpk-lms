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
            <div class="bg-white rounded-3xl border border-lpk-teal/10 p-6 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="space-y-1.5">
                    <span class="inline-block bg-lpk-mint text-lpk-teal font-bold text-xs px-3 py-1 rounded-full uppercase tracking-wider">
                        {{ $kursus->kategori->nama ?? 'Umum' }}
                    </span>
                    <h3 class="text-lg font-extrabold text-lpk-teal">{{ $kursus->judul }}</h3>
                    <p class="text-sm text-lpk-charcoal/70 line-clamp-2">{{ $kursus->deskripsi }}</p>
                    <span class="inline-block text-xs font-bold {{ $kursus->pivot->status === 'aktif' ? 'text-lpk-teal' : 'text-lpk-gold' }}">
                        Status: {{ ucfirst($kursus->pivot->status) }}
                    </span>
                </div>

                <div class="shrink-0 flex flex-col sm:flex-row gap-2">
                    @if($kursus->pivot->status === 'aktif')
                        <a href="{{ route('peserta.materi.index', $kursus->id) }}" class="text-center bg-lpk-gold hover:bg-opacity-90 text-lpk-charcoal text-xs font-extrabold px-6 py-3 rounded-full shadow-sm transition-all">
                            Lihat Materi
                        </a>
                    @endif
                    <a href="{{ url('/kursus/' . $kursus->slug) }}" class="text-center bg-lpk-teal hover:bg-lpk-charcoal text-lpk-bg text-xs font-extrabold px-6 py-3 rounded-full shadow-sm transition-all">
                        Lihat Kursus
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
