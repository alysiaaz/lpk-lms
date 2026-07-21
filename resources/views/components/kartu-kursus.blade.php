@props(['kursus'])

<div class="bg-lpk-mint rounded-3xl border border-lpk-teal/10 p-4 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
    <div>
        <!-- Thumbnail -->
        <div class="h-48 rounded-2xl relative overflow-hidden bg-gradient-to-tr from-lpk-teal to-lpk-teal/80">
            @if($kursus->thumbnail)
                <img src="{{ asset('storage/' . $kursus->thumbnail) }}" alt="{{ $kursus->judul }}" class="absolute inset-0 w-full h-full object-cover">
            @endif
            <div class="absolute inset-0 p-5 flex items-end justify-between">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-lpk-gold/20 rounded-full blur-xl group-hover:scale-150 transition-transform duration-500"></div>

                <span class="relative z-10 bg-lpk-bg/90 backdrop-blur-sm text-lpk-teal font-bold text-xs px-3 py-1.5 rounded-full shadow-sm">
                    {{ $kursus->kategori->nama ?? 'Umum' }}
                </span>
                @if($kursus->is_unggulan)
                    <span class="relative z-10 bg-lpk-gold text-lpk-charcoal font-extrabold text-xs px-3 py-1.5 rounded-full shadow-sm flex items-center">
                        ★ Unggulan
                    </span>
                @endif
            </div>
        </div>

        <!-- Teks Kartu -->
        <div class="p-4 pt-6">
            <h3 class="font-extrabold text-lg text-lpk-teal group-hover:text-lpk-gold transition-colors line-clamp-1">
                <a href="{{ url('/kursus/' . $kursus->slug) }}">{{ $kursus->judul }}</a>
            </h3>
            <p class="text-lpk-charcoal/80 text-xs mt-2.5 leading-relaxed line-clamp-2 font-normal">
                {{ $kursus->deskripsi }}
            </p>
            
            <!-- Fitur Singkat -->
            <div class="mt-5 pt-4 border-t border-lpk-teal/10 flex items-center justify-between text-xs font-semibold text-lpk-charcoal/70">
                <span class="flex items-center">
                    <span class="w-2 h-2 rounded-full bg-lpk-teal mr-2"></span>
                    {{ $kursus->peserta_count ?? 0 }} Siswa Terdaftar
                </span>
                <span class="text-lpk-teal font-bold">Sertifikasi Resmi</span>
            </div>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="px-4 pb-2 pt-2">
        <a href="{{ url ('/kursus/' . $kursus->slug) }}" class="w-full block text-center bg-lpk-teal hover:bg-lpk-charcoal text-lpk-bg text-xs font-bold py-3 rounded-xl transition-colors shadow-sm">
            Pelajari Program →
        </a>
    </div>
</div>