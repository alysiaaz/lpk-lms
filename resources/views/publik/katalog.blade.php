@extends('layouts.app')
@section('title', 'Katalog Program Pelatihan - LPK Karier Sukses')

@section('content')
    <!-- BANNER KATALOG -->
    <section class="bg-lpk-teal text-lpk-bg py-16 border-b border-lpk-teal/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
            <span class="text-lpk-gold text-xs font-extrabold tracking-widest uppercase bg-lpk-charcoal/30 px-3.5 py-1.5 rounded-full border border-lpk-gold/30">Katalog Resmi 2026</span>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Temukan Program Pelatihanmu</h1>
            <p class="text-lpk-bg/80 text-sm max-w-xl mx-auto font-normal">Kuasai skill baru yang paling dicari oleh industri saat ini, diajar langsung oleh praktisi berpengalaman.</p>

            <!-- FORM PENCARIAN & FILTER -->
            <div class="pt-6 max-w-2xl mx-auto">
                <form action="{{ url('/kursus') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-2 bg-lpk-bg p-2 rounded-3xl shadow-xl">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari keahlian (misal: Laravel, Figma, Marketing)..." class="w-full px-4 py-3 text-sm text-lpk-charcoal focus:outline-none bg-transparent font-medium">
                    
                    <select name="kategori" class="w-full sm:w-auto px-4 py-3 text-sm bg-lpk-mint text-lpk-teal font-bold rounded-2xl focus:outline-none cursor-pointer border border-lpk-teal/10">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->slug }}" {{ request('kategori') == $kat->slug ? 'selected' : '' }}>{{ $kat->nama }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="w-full sm:w-auto bg-lpk-gold hover:bg-opacity-90 text-lpk-charcoal font-extrabold px-8 py-3 rounded-2xl text-sm transition-all shadow-sm shrink-0">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- GRID HASIL KATALOG -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Informasi Hasil Filter -->
            @if(request('q') || request('kategori'))
                <div class="mb-8 flex items-center justify-between bg-lpk-mint p-4 rounded-2xl border border-lpk-teal/10">
                    <span class="text-xs font-bold text-lpk-teal">Menampilkan hasil pencarian untuk: <strong class="text-lpk-charcoal font-extrabold">"{{ request('q') ?: request('kategori') }}"</strong></span>
                    <a href="{{ url('/kursus') }}" class="text-xs font-extrabold text-red-600 hover:underline">✕ Reset Filter</a>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($semuaKursus as $item)
                    <!-- Menggunakan ulang komponen kartu kursus kita! -->
                    <x-kartu-kursus :kursus="$item" />
                @empty
                    <div class="col-span-3 text-center py-16 bg-lpk-mint rounded-3xl border border-dashed border-lpk-teal/20 space-y-3">
                        <div class="text-4xl">🔍</div>
                        <h3 class="font-bold text-lpk-teal text-lg">Program Tidak Ditemukan</h3>
                        <p class="text-lpk-charcoal/70 text-xs max-w-sm mx-auto font-normal">Maaf, kursus yang kamu cari belum tersedia atau kata kuncinya kurang tepat.</p>
                        <a href="{{ url('/kursus') }}" class="inline-block bg-lpk-teal text-lpk-bg text-xs font-bold px-6 py-2.5 rounded-xl mt-2">Lihat Semua Kursus</a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection