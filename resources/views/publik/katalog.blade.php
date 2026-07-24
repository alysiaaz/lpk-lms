@extends('layouts.app')
@section('title', 'Katalog Program Pelatihan - LPK Karier Sukses')

@section('content')
    <!-- BANNER KATALOG -->
    <section class="bg-lpk-teal text-lpk-bg py-16 border-b border-lpk-teal/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
            <span class="text-lpk-gold text-xs font-extrabold tracking-widest uppercase bg-lpk-charcoal/30 px-3.5 py-1.5 rounded-full border border-lpk-gold/30">Katalog Resmi 2026</span>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Temukan Program Pelatihanmu</h1>
            <p class="text-lpk-bg/80 text-sm max-w-xl mx-auto font-normal">Kuasai skill baru yang paling dicari oleh industri saat ini, diajar langsung oleh praktisi berpengalaman.</p>

            <!-- FORM PENCARIAN & FILTER DI BANNER -->
        </div>
    </section>

    <!-- GRID HASIL KATALOG -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            <!-- Filter Bar -->
            <div class="bg-white rounded-2xl shadow-sm border border-lpk-teal/10 p-6 mb-8">
                <form method="GET" action="{{ route('kursus.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search input -->
                    <div>
                        <label class="block text-sm font-bold text-lpk-teal mb-2">Cari Kursus</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Cari judul atau deskripsi..." 
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-lpk-teal focus:border-lpk-teal transition-colors">
                    </div>

                    <!-- Category filter -->
                    <div>
                        <label class="block text-sm font-bold text-lpk-teal mb-2">Kategori</label>
                        <select name="kategori_id" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-lpk-teal focus:border-lpk-teal transition-colors">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" 
                                        {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort -->
                    <div>
                        <label class="block text-sm font-bold text-lpk-teal mb-2">Urutkan</label>
                        <select name="sort" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-lpk-teal focus:border-lpk-teal transition-colors">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                            <option value="paling-diminati" {{ request('sort') == 'paling-diminati' ? 'selected' : '' }}>Paling Diminati</option>
                            <option value="harga-murah" {{ request('sort') == 'harga-murah' ? 'selected' : '' }}>Harga Murah</option>
                            <option value="harga-mahal" {{ request('sort') == 'harga-mahal' ? 'selected' : '' }}>Harga Mahal</option>
                        </select>
                    </div>

                    <!-- Submit button -->
                    <div class="flex items-end gap-2">
                        <button type="submit" class="w-full bg-lpk-teal hover:bg-opacity-90 text-white font-bold py-2 px-4 rounded-xl transition">
                            Cari
                        </button>
                        <a href="{{ route('kursus.index') }}" class="w-full bg-lpk-mint hover:bg-lpk-teal hover:text-white text-lpk-teal font-bold py-2 px-4 rounded-xl text-center transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Results count -->
            <div class="mb-6">
                <p class="text-gray-600">
                    Menampilkan <strong>{{ $semuaKursus->count() }}</strong> dari 
                    <strong>{{ $semuaKursus->total() }}</strong> kursus
                    @if(request('search'))
                        dengan pencarian: <strong>"{{ request('search') }}"</strong>
                    @endif
                </p>
            </div>

            <!-- Kursus Grid (HANYA 1 GRID) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @forelse($semuaKursus as $kursus)
                    <x-kartu-kursus :kursus="$kursus" />
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="text-4xl mb-3">🔍</div>
                        <p class="text-gray-500 text-lg font-bold">Tidak ada kursus yang sesuai</p>
                        <p class="text-gray-400 text-sm mb-4">Maaf, kursus yang kamu cari belum tersedia atau kata kuncinya kurang tepat.</p>
                        <a href="{{ route('kursus.index') }}" class="text-blue-600 hover:underline mt-2 inline-block font-semibold">
                            Kembali ke katalog lengkap
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mb-12">
                {{ $semuaKursus->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
@endsection